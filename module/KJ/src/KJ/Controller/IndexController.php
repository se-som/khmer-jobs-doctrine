<?php
namespace KJ\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {
	public function indexAction() {
		$jobs = $this->getEntityManager()->getRepository('\KJ\Entity\BJob')->findAll();
		return new ViewModel(array(
			'jobs' => $jobs,                      
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
                
		$jcat = new \KJ\Entity\BJobCategory();
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
                return $this->redirect()->toRoute('home');             			
	}
        public function deleteAction() {
		$id = $this->params('id');
		$job = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->find('\KJ\Entity\Bjobcategory', $id);         
		if(null == $job){
			$this->redirect()->toRoute('home', array('controller' => 'job', 'action' => 'index'));
		}
		$em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		$em->remove($job);
		$em->flush();
		return $this->redirect()->toRoute('home', array('controller' => 'job', 'action' => 'index'));
	}
        public function updateAction() {
		$request = $this->getRequest();
		if ($request->isPost()) {
			$postData = (array) $request->getPost();
			$id = $postData['job_id'];
			$job = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->find('\KJ\Entity\Bjob', $id);
			if(null == $job){
				$this->redirect()->toRoute('home/action', array('action' => 'index'));
			}
			if (isset($postData['job_title'])) {
                                $job->setJobDeadline($postData['job_deadline']);
                                $job->setJobTitle($postData['job_title']);
                                $job->setJobDescription($postData['job_description']);
				$em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
				$em->persist($job);
				$em->flush();
				$this->flashMessenger()->addMessage('<div class="alert alert-success">Success</div>');
				$this->redirect()->toRoute('home');
			}
                }
        }
        public function editAction() {
		$id = $this->params('id');
		$job = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default')->find('\KJ\Entity\Bjob', $id);               
		if(null == $job){
			$this->redirect()->toRoute('home/action', array('action' => 'index'));
		}
		return new ViewModel(array(
			'job' => $job,
			'submitText' => 'Update',
		));
	}
        
        
        public function newcategoryAction() {
        
		return new ViewModel(array(
			'submitText' => 'Save'
		));
	}  
        public function createCategoryAction()
        {
            $post = $this->getRequest()->getPost();          
            $cat = new \KJ\Entity\BCategory();
            $cat->setCatName($post->cat_name);		
            $this->getEntityManager()->persist($cat);
            $this->getEntityManager()->flush();       
            return $this->redirect()->toRoute('home'); 
        }
        
        
        public function newSubjectAction() {
        $category = $this->getEntityManager()->getRepository('\KJ\Entity\BCategory')->findAll();
		return new ViewModel(array(
			'submitText' => 'Save',
                        'category'=>$category
		));
	}
        public function createSubjectFormAction(){
            $post = $this->getRequest()->getPost();       
            $sub = new \KJ\Entity\BSubject();
            $sub->setSubName($post->sub_name);	     
            $this->getEntityManager()->persist($sub);
            $this->getEntityManager()->flush();  
            
            $subject = $this->getEntityManager()->find('\KJ\Entity\BSubject', $post->sub_id);
            $category = $this->getEntityManager()->find('\KJ\Entity\BCategory', $post->cat_id); 
            $catsub = new \KJ\Entity\BCatsubject();
            $catsub->setCat($category);
            $catsub->setSub($subject);           
            $this->getEntityManager()->persist($catsub);
            
            $this->getEntityManager()->flush();       
            return $this->redirect()->toRoute('home');           			
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

