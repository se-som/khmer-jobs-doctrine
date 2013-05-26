<?php


namespace KJ\Model;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use KJ\Model\Category;          

use Zend\Db\TableGateway\TableGateway;

class CategoryTable {

  protected $tableGateway;

  public function __construct(TableGateway $tableGateway) {
    $this->tableGateway = $tableGateway;
  }
  public function afindAll()
  {
	  return $this->tableGateway->select();
  }

  public function aafindAll()
  {
	  return $this->tableGateway->getAdapter()->query('select * from b_job as b join a_jobs_jseeker as a on b.job_id = a.jobs_id
														join jobs_users as d on a.user_id = d.id
														join a_company as c on a.com_id = c.com_i',  
														\Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
  }



  public function aaafindAll(){
    return $this->tableGateway->getAdapter()->query('select * from b_category as c join b_jobcategory as jc on c.cat_id = jc.cat_id
join a_company as com on com.com_id = jc.com_id
join b_job as j on j.jcat_id = jc.jcat_id', \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
  }
  public function findAll()
  {
	  return $this->tableGateway->getAdapter()->query('select * from b_job as b join b_jobcategory as a on a.jcat_id = b.jcat_id
														join a_company as c on a.com_id = c.com_id',
			  \Zend\Db\Adapter\Adapter::QUERY_MODE_EXECUTE);
  }
}
