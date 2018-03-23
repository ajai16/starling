<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;


class BasicController extends AbstractActionController
{
    
    protected $em;
    /**
    * @var Storage\StorageInterface
    */
    protected $storage;
    
    /**
    * @var SessionContainer
    */
    protected $authservice;
 
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }
    
    /*
     * Function to bind data to entity
     * 
     * @ object $entity
     * @ array $data
     * 
     * @ return object $entity
     */
    protected function saveRow($entity, $data) 
    {
        foreach($data as $attribute => $value) {
            $method = 'set' . ucfirst($attribute);
            is_callable(array($entity, $method)) ? $entity->$method($value) : '';            
        }
        
        return $entity;
    }
    
    public function getAuthService()
    {
        if (!$this->authservice) {
            $this->authservice = $this->getServiceLocator()->get('AuthService');
        }
        return $this->authservice;
    }
    
    public function getSessionStorage()
    {
        if (!$this->storage) {
            $this->storage = $this->getServiceLocator()->get('AuthStorage');
        }
        return $this->storage;
    }
}
