<?php

namespace KJ\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

	public function indexAction() {
		return new ViewModel();
	}

	
        public function showJobAction(){
		
		$jobs = $this->getEntityManager()->getRepository('\KJ\Entity\BJob')->findAll();
		
		return new ViewModel(array(
			'jobs' => $jobs
		));
	}
        public function newJobAction(){
				
		return new ViewModel(array(
				'categories' => $this->getEntityManager()->getRepository('\KJ\Entity\BCategory')->findAll(),
		));
	}

        public function createJobByFormAction(){
		$post = $this->getRequest()->getPost();
		
		$company = $this->getEntityManager()->find('\KJ\Entity\ACompany', $post->com_id);
		$category = $this->getEntityManager()->find('\KJ\Entity\BCategory', $post->cat_id);
		
		$jcat = new \KJ\Entity\BJobCagtegory();
		$jcat->setCat($category);
		$jcat->setCom($company);
		$job = new \KJ\Entity\BJob();
		$job->setJobTitle($post->job_title);
                $job->setJobDeadline($post->job_deadline);
		$job->setJobDescription($post->job_description);		
		$job->setJcat($jcat);
                
		$this->getEntityManager()->persist($jcat);           
		$this->getEntityManager()->persist($job);
		$this->getEntityManager()->flush();
                
                return $this->redirect()->toRoute('home/action', array(
                    'action' => 'showjob'
                ));             			
	}
        
        
        
        
        
        

	/**
	 * Entity manager instance
	 *           
	 * @var Doctrine\ORM\EntityManager
	 */
	protected $em;

	/**
	 * Returns an instance of the Doctrine entity manager loaded from the service 
	 * locator
	 * 
	 * @return Doctrine\ORM\EntityManager
	 */
	public function getEntityManager() {
		if (null === $this->em) {
			$this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		}
		return $this->em;
	}
}

