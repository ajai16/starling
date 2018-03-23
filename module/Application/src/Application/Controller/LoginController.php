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
        if($request->isPost()) {
            $email = $request->getPost('email', '');
            $password = $request->getPost('password');
            
            $this->em = $this->getEntityManager();
            $savedRow = $this->saveRow($this->getEntity(), $data);
            $this->em->persist($savedRow);
            $this->em->flush();
            $this->redirect()->toRoute('application');
        }
        echo 'Welcom to Login page'; die;
    }
    
    public function forgotPasswordAction() {
        
    }
    
}