<?php
namespace Restgrip\Controller;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\View\Simple;
use Restgrip\Event\EventsManager;
use Restgrip\Router\Route;
use Restgrip\Router\Router;
use Restgrip\Validation\Validation;

/**
 * @property  Simple        $view
 * @property  Router        $router
 * @property  EventsManager $eventsManager
 * @package   Restgrip\Controller
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class RestgripController extends Controller
{
    /**
     * Get current route object.
     *
     * @return Route
     */
    protected function currentRoute()
    {
        return $this->router->getMatchedRoute();
    }
    
    /**
     * Get current route validation object.
     *
     * @return Validation|mixed
     */
    protected function currentValidation()
    {
        return $this->router->getMatchedRoute()->getValidation();
    }
}