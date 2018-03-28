<?php

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Application\Controller\BasicController;

class DashboardController extends BasicController 
{
    public function indexAction() {
        if (! $this->getAuthService()->hasIdentity()){
            return $this->redirect()->toRoute('login');
        }
        $this->getSessionStorage();
    }
}
