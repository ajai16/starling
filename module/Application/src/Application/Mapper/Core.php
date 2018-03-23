<?php

namespace Application\Mapper;

use Doctrine\ORM\EntityManager;

class Core {
    public $em;
    
    public function __construct()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
//        return $this->em;
    }
}
