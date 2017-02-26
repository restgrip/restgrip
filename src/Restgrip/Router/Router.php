<?php
namespace Restgrip\Router;

use Phalcon\Mvc\Router as BaseRouter;

/**
 * @method Route[]|BaseRouter\RouteInterface[] getRoutes()
 * @method Route getMatchedRoute()
 * @package   Restgrip\Router
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class Router extends BaseRouter
{
    /**
     * @param string    $pattern
     * @param null      $paths
     * @param null      $httpMethods
     * @param int|mixed $position
     *
     * @return Route
     */
    public function add($pattern, $paths = null, $httpMethods = null, $position = BaseRouter::POSITION_LAST)
    {
        $route = new Route($pattern, $paths, $httpMethods);
        
        switch ($position) {
            case self::POSITION_LAST:
                $this->_routes[] = $route;
                break;
            case self::POSITION_FIRST:
                $this->_routes = array_merge([$route], $this->_routes);
                break;
        }
        
        return $route;
    }
}