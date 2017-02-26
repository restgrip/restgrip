<?php
namespace Restgrip\Validation\Validator;

use Phalcon\Validation;
use Phalcon\Validation\Validator;

/**
 * @package   Restgrip\Validation\Validator
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class JsonString extends Validator
{
    /**
     * @param Validation $validation
     * @param string     $attribute
     *
     * @return bool
     */
    public function validate(Validation $validation, $attribute)
    {
        $value = $validation->getValue($attribute);
        
        json_decode($value);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            $message = $this->getOption('message');
            
            if (!$message) {
                $message = sprintf("Field %s is not a valid JSON string", $attribute);
            }
            
            $validation->appendMessage(new Validation\Message($message, $attribute, 'JsonString'));
            
            return false;
        }
        
        return true;
    }
}