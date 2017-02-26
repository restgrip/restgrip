<?php
namespace Restgrip\Exception;

/**
 * @package   Restgrip\Exception
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class BadRequestException extends RestgripException
{
    /**
     * @param string $message
     * @param int    $code
     */
    public function __construct($message = 'Bad Request', $code = 400)
    {
        parent::__construct($message, $code);
    }
}