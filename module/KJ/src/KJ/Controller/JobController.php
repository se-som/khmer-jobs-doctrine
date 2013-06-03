<?php

namespace KJ\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use DOMPDFModule\View\Model\PdfModel;
use KJ\Model\Category;



class JobController extends AbstractActionController {

	protected $category;


	public function indexAction() {
    
         $pdf = new PdfModel();
        $pdf->setOption('filename', 'monthly-report'); // Triggers PDF download, automatically appends ".pdf"
        $pdf->setOption('paperSize', 'a4'); // Defaults to "8x11"
        $pdf->setOption('paperOrientation', 'landscape'); // Defaults to "portrait"

        // To set view variables
        $pdf->setVariables(array(
          'message' => 'Hello'
        ));

        return $pdf;
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

