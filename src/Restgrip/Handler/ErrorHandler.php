<?php
namespace Restgrip\Handler;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Http\RequestInterface;
use Phalcon\Http\ResponseInterface;
use Restgrip\Container\ContainerTrait;
use Restgrip\Exception\InputValidationException;
use Restgrip\Exception\RestgripException;

/**
 * @package   Restgrip\Handler
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class ErrorHandler implements InjectionAwareInterface
{
    use ContainerTrait;
    
    /**
     * @param \Exception $exception
     *
     * @return ResponseInterface
     */
    public function __invoke(\Exception $exception)
    {
        $errorCode = $exception->getCode();
        $message   = $exception->getMessage();
        $content   = [];
        
        if ($exception instanceof RestgripException) {
            $content['code']    = $exception->getSubcode();
            $content['message'] = $message;
            
            if ($exception instanceof InputValidationException) {
                $content['fields'] = $exception->getFields();
            }
        } else {
            $content['code']    = $errorCode;
            $content['message'] = 'Internal Server Error';
            
            do {
                $content['exception'][] = [
                    'type'    => get_class($exception),
                    'code'    => $exception->getCode(),
                    'message' => $exception->getMessage(),
                    'file'    => $exception->getFile(),
                    'line'    => $exception->getLine(),
                    'trace'   => explode("\n", $exception->getTraceAsString()),
                ];
            } while ($exception = $exception->getPrevious());
        }
        
        if ($errorCode === 0 || $errorCode >= 500 || is_string($errorCode)) {
            $errorCode = 500;
        }
        
        /* @var $response ResponseInterface */
        $response = $this->getDI()->getShared('response');
        $response->setStatusCode($errorCode);
        
        /* @var $request RequestInterface */
        $request    = $this->getDI()->getShared('request');
        $acceptType = $request->getBestAccept();
        
        switch ($acceptType) {
            case 'text/xml':
            case 'application/xml':
                // @TODO XML
                $response->setJsonContent($content);
                break;
            default:
                $response->setJsonContent($content);
                break;
        }
        
        return $response;
    }
}