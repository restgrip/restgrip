<?php
namespace Restgrip\Event;

use Phalcon\DiInterface;
use Phalcon\Events\ManagerInterface;

/**
 * @method DiInterface getDI()
 * @package   Restgrip\Event
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
trait EventsManagerTrait
{
    /**
     * @var ManagerInterface
     */
    private $eventsManager;
    
    /**
     * @param ManagerInterface $eventsManager
     */
    public function setEventsManager(ManagerInterface $eventsManager)
    {
        $this->eventsManager = $eventsManager;
    }
    
    /**
     * @return ManagerInterface|EventsManager
     */
    public function getEventsManager()
    {
        if (!$this->eventsManager && $this->getDI()) {
            $this->eventsManager = $this->getDI()->getShared('eventsManager');
        }
        
        return $this->eventsManager;
    }
}