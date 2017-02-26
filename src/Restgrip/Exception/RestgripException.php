<?php
namespace Restgrip\Exception;

/**
 * @package   Restgrip\Exception
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class RestgripException extends \Exception
{
    /**
     * @var int
     */
    protected $subcode = 0;
    
    /**
     * @param string $message
     * @param int    $code This will be used as http status code
     */
    public function __construct($message = '', $code = 400)
    {
        parent::__construct($message, $code);
    }
    
    /**
     * @param int $subcode
     */
    public function setSubcode(int $subcode)
    {
        $this->subcode = $subcode;
    }
    
    /**
     * @return int
     */
    public function getSubcode() : int
    {
        if ($this->subcode === 0) {
            $this->subcode = $this->code;
        }
        
        return $this->subcode;
    }
}