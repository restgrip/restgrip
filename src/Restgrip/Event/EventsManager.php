<?php
namespace Restgrip\Event;

use Phalcon\Events\Manager;

/**
 * @package   Restgrip\Event
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class EventsManager extends Manager
{
    /**
     * @return array
     */
    public function getRegisteredListeners() : array
    {
        if (!$this->arePrioritiesEnabled()) {
            throw new \OutOfBoundsException('Priority must be enabled');
        }
        
        $events = [];
        if (is_array($this->_events)) {
            foreach ($this->_events as $scope => $storage) {
                /* @var $storage \SplPriorityQueue */
                $storage = clone $storage;
                $storage->setExtractFlags(\SplPriorityQueue::EXTR_BOTH);
                
                while ($storage->valid()) {
                    $handler = $storage->current();
                    $data    = [
                        'class'    => get_class($handler['data']),
                        'priority' => $handler['priority'],
                    ];
                    
                    $events[$scope][] = $data;
                    $storage->next();
                }
            }
        }
        
        arsort($events);
        
        return $events;
    }
}