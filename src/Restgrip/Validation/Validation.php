<?php
namespace Restgrip\Validation;

use Phalcon\Validation as BaseValidation;

/**
 * @method initialize()
 * @package   Restgrip\Validation
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class Validation extends BaseValidation
{
    /**
     * Flag whether validation class has been validated on router level.
     *
     * @var bool
     */
    private $validated = false;
    
    /**
     * @param bool $validated
     */
    public function setValidated(bool $validated)
    {
        $this->validated = $validated;
    }
    
    /**
     * @return bool
     */
    public function isValidated() : bool
    {
        return $this->validated;
    }
    
    /**
     * @return array
     */
    public function toArray() : array
    {
        if (!$this->isValidated()) {
            throw new \RuntimeException('Data must be passed validation process !');
        }
        
        $fields = array_flip(array_unique(array_column($this->_validators, 0)));
        
        foreach ($fields as $field => $value) {
            $fields[$field] = $this->getValue($field);
        }
        
        return $fields;
    }
}