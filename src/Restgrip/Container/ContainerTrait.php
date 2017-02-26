<?php
namespace Restgrip\Container;

use Phalcon\DiInterface;

/**
 * @package   Restgrip\Container
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
trait ContainerTrait
{
    /**
     * @var DiInterface
     */
    private $container;
    
    /**
     * @param DiInterface $dependencyInjector
     */
    public function setDI(DiInterface $dependencyInjector)
    {
        $this->container = $dependencyInjector;
    }
    
    /**
     * @return DiInterface
     */
    public function getDI()
    {
        return $this->container;
    }
}