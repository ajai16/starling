<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Application\Controller\BasicController;

class LoginController extends BasicController 
{
    public function indexAction() {
        $request = $this->getRequest();
        $email = $request->getPost('email', 'rohit@ymail.com');
        $password = $request->getPost('password', '111');
        $password = md5($password);
        
        $data = [
            'email' => $email,
            'password'  => $password
        ];
        
        $this->em = $this->getEntityManager();
        $personMapper = new \Application\Mapper\Person($this->em);
        
        
        $userRow = $personMapper->getUserRow($data);
        
        if(!$userRow) {
            echo "Invalid Username and password !";
        }
        
        $userData = [
            'id'    => $userRow->getId(),
            'firstName' => $userRow->getFirstName(),
            'lastName'  => $userRow->getLastName(),
            'email' => $userRow->getEmail()
        ];
        
        $this->getAuthService()->setStorage($this->getSessionStorage());
        $this->getAuthService()->getStorage()->write($userData);
        
        echo '<pre>'; print_r($_SESSION); die;
        
        if($request->isPost()) {
            $email = $request->getPost('email', 'rohit@ymail.com');
            $password = $request->getPost('password', '111');
            $password = md5($password);
            
            $this->em = $this->getEntityManager();
            $savedRow = $this->saveRow($this->getEntity(), $data);
            $this->em->persist($savedRow);
            $this->em->flush();
            $this->redirect()->toRoute('home');
        }
        echo 'Welcom to Login page'; die;
    }
    
    public function forgotPasswordAction() {
        
    }
    
}