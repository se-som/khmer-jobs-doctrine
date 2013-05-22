<?php

namespace KJ\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class JobController extends AbstractActionController {

	public function indexAction() {

		return new ViewModel(array(
			'jobs' => $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->getRepository('\KJ\Entity\Bjob')->findAll(),
			'messages' => $this->flashMessenger()->getMessages(),
		));
	}

	public function newAction() {
		return new ViewModel(array(
			'submitText' => 'Save'
		));
	}

	public function editAction() {
//		$id = $this->params('id');
//		$job = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->find('\KJ\Entity\Bjob', $id);
//		
//		if(null == $job){
//			$this->redirect()->toRoute('home', array('controller' => 'job', 'action' => 'index'));
//		}
//		
//		return new ViewModel(array(
//			'job' => $job,
//			'submitText' => 'Update',
//		));
	}

	public function updateAction() {
		$request = $this->getRequest();

		if ($request->isPost()) {
			$postData = (array) $request->getPost();
			
			$id = $postData['id'];
			$job = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->find('\KJ\Entity\Bjob', $id);

			if(null == $job){
				$this->redirect()->toRoute('home', array('controller' => 'job', 'action' => 'index'));
			}
		
			if (isset($postData['brand'])) {
				
				$job->setBrandName($postData['brand']);

				$em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
				$em->persist($job);
				$em->flush();

				$this->flashMessenger()->addMessage('<div class="alert alert-success">Success</div>');
				$this->redirect()->toRoute('home', array('controller' => 'job', 'action' => 'index'));
			}
		}
	}
	
		public function deleteAction() {
		$id = $this->params('id');
		$job = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->find('\KJ\Entity\Bjob', $id);
		if(null == $job){
			$this->redirect()->toRoute('home', array('controller' => 'job', 'action' => 'index'));
		}

		$em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		$em->remove($job);
		$em->flush();

		$this->flashMessenger()->addMessage('<div class="alert alert-success">Success</div>');
		return $this->redirect()->toRoute('home', array('controller' => 'job', 'action' => 'index'));
	}

	
	public function createAction() {
		
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
                    'action' => 'index'
                ));  
        }

}
