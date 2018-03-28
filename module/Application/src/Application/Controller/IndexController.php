<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Application\Controller\BasicController;


class IndexController extends BasicController
{
    protected $currentTab = null;
    public function __construct() {
        $this->currentTab = "home";
    }
    
    public function indexAction()
    {
        // $layout = $this->layout();
        // $layout->setTemplate('layout/layout');
        $this->em = $this->getEntityManager();
        $personMapper = new \Application\Mapper\Person($this->em);
        $personList = $personMapper->getUserList();

        $this->layout()->currentTab = $this->currentTab;
        return new ViewModel(array(
            'personList' => $personList,
        ));
    }
    
    public function getEntity() {
        return new \Application\Entity\Persons();
    }

    public function addAction() {
        $request = $this->getRequest();
        if($request->isPost()) {
            $data = array(
                'firstName' => $request->getPost('firstName'),
                'lastName'  => $request->getPost('lastName'),
                'email'     => $request->getPost('email'),
                'password'  => md5($request->getPost('password')),
                'age'       => 27,
//                'role'    => 1
            );
            $this->em = $this->getEntityManager();
            $savedRow = $this->saveRow($this->getEntity(), $data);
            $this->em->persist($savedRow);
            $this->em->flush();
            $this->redirect()->toRoute('home');
        }
        $view = new ViewModel();
        $this->layout()->currentTab = $this->currentTab;
        $view->setTemplate('application/index/add.phtml');
        return $view;
    }
}
