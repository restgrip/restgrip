<?php
namespace Restgrip\Validation\Validator;

use Phalcon\Validation;
use Phalcon\Validation\Validator;

/**
 * @package   Restgrip\Validation\Validator
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class Uuid extends Validator
{
    /**
     * @author Ivan Gabriele <http://stackoverflow.com/users/2736233/ivan-gabriele>
     * @link   http://stackoverflow.com/a/38191078/1181053
     * @var array
     */
    protected $patterns = [
        1 => '~^[0-9A-F]{8}-[0-9A-F]{4}-[1][0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$~i',
        2 => '~^[0-9A-F]{8}-[0-9A-F]{4}-[2][0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$~i',
        3 => '~^[0-9A-F]{8}-[0-9A-F]{4}-[3][0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$~i',
        4 => '~^[0-9A-F]{8}-[0-9A-F]{4}-[4][0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$~i',
        5 => '~^[0-9A-F]{8}-[0-9A-F]{4}-[5][0-9A-F]{3}-[89AB][0-9A-F]{3}-[0-9A-F]{12}$~i',
    ];
    
    /**
     * @param Validation $validation
     * @param string     $attribute
     *
     * @return bool
     */
    public function validate(Validation $validation, $attribute)
    {
        $value   = $validation->getValue($attribute);
        $version = $this->getOption('version', 4);
        
        if (!array_key_exists((int)$version, $this->patterns)) {
            throw new \InvalidArgumentException('Unregistered UUID v'.(int)$version.' validator');
        }
        
        if (!$this->match($this->patterns[(int)$version], $value)) {
            $message = $this->getOption('message');
            
            if (!$message) {
                $message = sprintf("Field %s is not a valid UUID v%s", $attribute, $version);
            }
            
            $validation->appendMessage(new Validation\Message($message, $attribute, 'Uuid'));
        }
        
        return true;
    }
    
    /**
     * @param string $pattern
     * @param mixed  $value
     *
     * @return bool
     */
    protected function match(string $pattern, $value)
    {
        $result = preg_match($pattern, $value);
        
        if ($result === 0) {
            return false;
        }
        
        return true;
    }
}