<?php
namespace Restgrip\Exception;

/**
 * @package   Restgrip\Exception
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class UnauthorizedException extends RestgripException
{
    /**
     * @param string $message
     */
    public function __construct($message = 'Unauthorized Request')
    {
        parent::__construct($message, 401);
    }
}