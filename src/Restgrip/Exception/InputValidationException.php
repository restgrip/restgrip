<?php
namespace Restgrip\Exception;

/**
 * @package   Restgrip\Exception
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class InputValidationException extends RestgripException
{
    /**
     * @var array
     */
    private $fields = [];
    
    /**
     * @param string $message
     * @param int    $code
     */
    public function __construct($message = 'Invalid Data', $code = 422)
    {
        parent::__construct($message, $code);
    }
    
    /**
     * @param array $fields
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }
    
    /**
     * @return array
     */
    public function getFields() : array
    {
        return $this->fields;
    }
}