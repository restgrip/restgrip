<?php
namespace Restgrip\Router;

use Phalcon\Mvc\Micro\Collection as BaseRouteCollection;
use Restgrip\Micro\Application;

/**
 * @package   Restgrip\Router
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class RouteCollection extends BaseRouteCollection
{
    /**
     * Mark route as lazy object
     *
     * @var bool
     */
    protected $_lazy = true;
    
    /**
     * Helper method to add route handlers definition with custom structure.
     *
     * @see Application::mount()
     *
     * @param string      $httpMethod    Single http method name
     * @param string      $path          Endpoint path
     * @param string      $handlerMethod Method name inside controller
     * @param string      $name          Route unique name
     * @param null|string $validator     Validator FQDN classname
     * @param bool        $visible       Visibility for api documentation
     * @param string      $auth          Required authentication type
     * @param string      $scope         Required authentication scope
     * @param string      $role          Required authentication role
     */
    public function addRoute(
        string $httpMethod,
        string $path,
        string $handlerMethod,
        string $name,
        $validator = null,
        bool $visible = true,
        string $auth = null,
        string $scope = null,
        string $role = null
    ) {
        $this->_handlers[] = [
            strtoupper($httpMethod),
            $path,
            $handlerMethod,
            $name,
            $validator,
            $visible,
            $auth,
            $scope,
            $role,
        ];
    }
}