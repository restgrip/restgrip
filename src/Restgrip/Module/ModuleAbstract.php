<?php
namespace Restgrip\Module;

use Phalcon\Mvc\Micro;
use Restgrip\Container\ContainerTrait;

/**
 * @package   Restgrip\Module
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
abstract class ModuleAbstract implements ModuleInterface
{
    use ContainerTrait;
    
    /**
     * @var Micro
     */
    protected $app;
    
    
    /**
     * Default services not required custom object creation step. Only setup DI container and eventsManager.
     * To setup custom service which require extra setup, use services() method.
     *
     * @var array
     */
    protected $defaultServices = [];
    
    /**
     * @param Micro $app
     */
    public function register(Micro $app)
    {
        $this->app = $app;
        
        if (count($this->defaultServices)) {
            foreach ($this->defaultServices as $serviceName) {
                // https://docs.phalconphp.com/en/latest/reference/di.html#string
                $this->getDI()->setShared($serviceName, $serviceName);
            }
        }
        
        $this->services();
        
        if (PHP_SAPI === 'cli') {
            $this->console();
        } else {
            $this->http();
        }
    }
    
    /**
     * Setup services which available for both console and http.
     *
     * @return void
     */
    protected function services()
    {
    }
    
    /**
     * Setup module http related settings, eg: routing collection mount.
     *
     * @return void
     */
    protected function http()
    {
    }
    
    /**
     * Setup console related settings, eg: command, migration path, seed path
     *
     * @return void
     */
    protected function console()
    {
    }
}