<?php
namespace Restgrip\Exception;

/**
 * @package   Restgrip\Exception
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class NotFoundException extends RestgripException
{
    /**
     * @param string $message
     */
    public function __construct($message = 'Not Found')
    {
        parent::__construct($message, 404);
    }
}