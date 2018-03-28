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
    protected $currentTab = null;
    public function __construct() {
        $this->currentTab = "login";
    }
    
    public function indexAction() {
        $request = $this->getRequest();
        $authService = $this->getAuthService();
        
        if ($authService->hasIdentity()){
            return $this->redirect()->toRoute('dashboard');
        }
        
        if($request->isPost()) {
            $email = $request->getPost('email');
            $password = $request->getPost('password');
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
            $authService->setStorage($this->getSessionStorage());
            $authService->getStorage()->write($userData);
            $this->redirect()->toRoute('dashboard');
        }
        $this->layout()->currentTab = $this->currentTab;
    }
    
    public function forgotPasswordAction() {
        
    }
    
    public function logoutAction() {
        $this->getSessionStorage()->forgetMe();
        $this->getAuthService()->clearIdentity();
         
        $this->flashmessenger()->addMessage("You've been logged out");
        return $this->redirect()->toRoute('login');
    }
    
}