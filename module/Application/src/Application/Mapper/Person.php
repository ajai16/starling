<?php

namespace Application\Mapper;

class Person {
    
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    
    protected $entity = 'Application\Entity\Persons';
    public $em = null;
    
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function getUserList() {
        $personList = $this->em->getRepository($this->entity)->findAll();
        return $personList;
    }

    public function getUserRow() {
        
    }
            
}
