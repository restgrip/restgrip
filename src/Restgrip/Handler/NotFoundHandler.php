<?php
namespace Restgrip\Handler;

use Restgrip\Exception\NotFoundException;

/**
 * @package   Restgrip\Handler
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class NotFoundHandler
{
    /**
     * @throws NotFoundException
     */
    public function __invoke()
    {
        throw new NotFoundException('Not Found');
    }
}