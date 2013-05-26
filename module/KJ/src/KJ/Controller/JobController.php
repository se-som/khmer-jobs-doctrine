<?php

namespace KJ\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use KJ\Model\Category;

class JobController extends AbstractActionController {

	protected $category;


	public function indexAction() {
    
    $ite = $this->getCategoryTable()->findAll();
    
    foreach ($ite as $item) {
      var_dump($item);
    }
	}
	public function getCategoryTable()
    {
        if (!$this->category) {
            $sm = $this->getServiceLocator();
            $this->category = $sm->get('KJ\Model\CategoryTable');
        }
        return $this->category;
    }	
}

