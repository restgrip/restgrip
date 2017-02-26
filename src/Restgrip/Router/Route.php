<?php
namespace Restgrip\Router;

use Phalcon\Mvc\Router\Route as BaseRoute;
use Restgrip\Validation\Validation;

/**
 * @package   Restgrip\Router
 * @author    Sarjono Mukti Aji <me@simukti.net>
 */
class Route extends BaseRoute
{
    /**
     * Validation class name for this route request
     *
     * @var string|Validation
     */
    protected $validation;
    
    /**
     * Resource scope
     *
     * @var string
     */
    protected $scope;
    
    /**
     * Minimum allowed role
     *
     * @var string
     */
    protected $role;
    
    /**
     * @var bool
     */
    protected $visible = true;
    
    /**
     * @var string
     */
    protected $authType;
    
    /**
     * @var string
     */
    protected $groupName;
    
    /**
     * @var string
     */
    protected $actionClass;
    
    /**
     * @var string
     */
    protected $actionMethod;
    
    /**
     * @param string $actionClass
     */
    public function setActionClass(string $actionClass)
    {
        $this->actionClass = $actionClass;
    }
    
    /**
     * @return string
     */
    public function getActionClass() : string
    {
        return $this->actionClass;
    }
    
    /**
     * @param string $actionMethod
     */
    public function setActionMethod(string $actionMethod)
    {
        $this->actionMethod = $actionMethod;
    }
    
    /**
     * @return string
     */
    public function getActionMethod() : string
    {
        return $this->actionMethod;
    }
    
    /**
     * @param null|string $groupName
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
    }
    
    /**
     * @return null|string
     */
    public function getGroupName()
    {
        return $this->groupName;
    }
    
    /**
     * @param null|string $authType
     */
    public function setAuthType($authType)
    {
        $this->authType = $authType;
    }
    
    /**
     * @return null|string
     */
    public function getAuthType()
    {
        return $this->authType;
    }
    
    /**
     * $validation is \Phalcon\Validation object only after passed validation process in
     * \Restgrip\Router\EventListener\RouterEventListener::matchedRoute()
     *
     * @param string|Validation $validation
     */
    public function setValidation($validation)
    {
        $this->validation = $validation;
    }
    
    /**
     * Will return Validation object if previously validated on router level.
     *
     * @return string|Validation
     */
    public function getValidation()
    {
        return $this->validation;
    }
    
    /**
     * @param null|string $scope
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    }
    
    /**
     * @return null|string
     */
    public function getScope()
    {
        return $this->scope;
    }
    
    /**
     * @param null|string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
    
    /**
     * @return null|string
     */
    public function getRole()
    {
        return $this->role;
    }
    
    /**
     * @param bool $visible
     */
    public function setVisible(bool $visible)
    {
        $this->visible = $visible;
    }
    
    /**
     * @return bool
     */
    public function isVisible() : bool
    {
        return $this->visible;
    }
    
    /**
     * @return array
     */
    public function toArray() : array
    {
        return [
            'id'         => $this->getRouteId(),
            'group'      => $this->getGroupName(),
            'method'     => $this->getHttpMethods(),
            'path'       => $this->getCompiledPattern(),
            'name'       => $this->getName(),
            'validation' => $this->getValidation(),
            'visible'    => $this->isVisible(),
            'auth'       => $this->getAuthType(),
            'role'       => $this->getRole(),
            'scope'      => $this->getScope(),
            'pattern'    => $this->getPattern(),
            'controller' => $this->getActionClass(),
            'action'     => $this->getActionMethod(),
        ];
    }
}