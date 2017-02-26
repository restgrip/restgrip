<?php
namespace Restgrip\Module;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Mvc\Micro;

/**
 * @package   Restgrip\Module
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
interface ModuleInterface extends InjectionAwareInterface
{
    /**
     * Setup anything related to rest module.
     *
     * @param Micro $app
     *
     * @return void
     */
    public function register(Micro $app);
}