<?php
namespace Restgrip\Router\EventListener;

use Phalcon\Events\Event;
use Phalcon\Http\Request;
use Phalcon\Validation\Message;
use Restgrip\Exception\InputValidationException;
use Phalcon\Mvc\Router\Route;
use Restgrip\Router\Route as RestgripRoute;
use Restgrip\Router\Router;
use Restgrip\Validation\Validation;

/**
 * @package   Restgrip\Router\EventListener
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class RouterEventListener
{
    /**
     * Validate if matched route previously define a request validator.
     *
     * @param Event  $event
     * @param Router $router
     * @param Route  $route
     *
     * @throws InputValidationException If validation is not passed.
     */
    public function matchedRoute(Event $event, Router $router, Route $route)
    {
        if (!$route instanceof RestgripRoute) {
            return;
        }
        
        unset($event);
        
        $validationClass = $route->getValidation();
        if (!$validationClass) {
            return;
        }
        
        $validationClass = new $validationClass;
        if (!$validationClass instanceof Validation) {
            throw new \InvalidArgumentException('Validation class must be subclass of '.Validation::class);
        }
        
        $di = $router->getDI();
        
        /* @var $request Request */
        $request = $di->getShared('request');
        $method  = $request->getMethod();
        
        switch ($method) {
            case 'GET':
            case 'DELETE':
                $data = $request->getQuery();
                break;
            case 'POST':
                $data = $request->getPost();
                if ($request->hasFiles()) {
                    $data = array_merge($data, $this->getFiles($request->getUploadedFiles(true)));
                }
                break;
            case 'PUT':
                $data = $request->getPut();
                if ($request->hasFiles()) {
                    $data = array_merge($data, $this->getFiles($request->getUploadedFiles(true)));
                }
                break;
            default:
                $data = [];
        }
        
        $evm = $di->getShared('eventsManager');
        $evm->fire('route:beforeValidation', $request, $route);
        
        /* @var $messages Message[] */
        $messages = $validationClass->validate($data);
        if (count($messages)) {
            $error = [];
            foreach ($messages as $message) {
                $error[$message->getField()] = ucfirst(
                    str_replace('Field '.$message->getField().' ', '', $message->getMessage())
                );
            }
            
            $exception = new InputValidationException();
            $exception->setSubcode(422000);
            $exception->setFields($error);
            
            throw $exception;
        }
        
        $validationClass->setValidated(true);
        
        $evm->fire('route:afterValidation', $request, $route);
        
        // now set back route validation with validated validation object
        $route->setValidation($validationClass);
    }
    
    /**
     * Extract file data for Phalcon validation
     *
     * @param array $uploadedFiles
     *
     * @return array
     */
    private function getFiles(array $uploadedFiles) : array
    {
        $data = [];
        if (!count($uploadedFiles)) {
            return $data;
        }
        
        /* @var $file Request\File */
        foreach ($uploadedFiles as $file) {
            $data[$file->getKey()] = [
                // this required for Phalcon File validator
                'name'      => $file->getName(),
                'type'      => $file->getRealType(),
                'size'      => $file->getSize(),
                'tmp_name'  => $file->getTempName(),
                'error'     => $file->getError(),
                'extension' => $file->getExtension(),
            ];
        }
        
        return $data;
    }
}