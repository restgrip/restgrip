<?php
namespace Restgrip\Service;

use Phalcon\Di\InjectionAwareInterface;
use Phalcon\Events\EventsAwareInterface;
use Restgrip\Container\ContainerTrait;
use Restgrip\Event\EventsManagerTrait;

/**
 * @package   Restgrip\Service
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
abstract class ServiceAbstract implements InjectionAwareInterface, EventsAwareInterface
{
    use ContainerTrait, EventsManagerTrait;
}