<?php

namespace KJ\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BJob
 *
 * @ORM\Table(name="b_job")
 * @ORM\Entity
 */
class BJob
{
    /**
     * @var integer
     *
     * @ORM\Column(name="job_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $jobId;

    /**
     * @var string
     *
     * @ORM\Column(name="job_title", type="string", length=255, nullable=true)
     */
    private $jobTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="job_deadline", type="string", length=250, nullable=false)
     */
    private $jobDeadline;

    /**
     * @var string
     *
     * @ORM\Column(name="job_description", type="text", nullable=true)
     */
    private $jobDescription;

    /**
     * @var \KJ\Entity\BJobcategory
     *
     * @ORM\ManyToOne(targetEntity="KJ\Entity\BJobcategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jcat_id", referencedColumnName="jcat_id")
     * })
     */
    private $jcat;



    /**
     * Get jobId
     *
     * @return integer 
     */
    public function getJobId()
    {
        return $this->jobId;
    }

    /**
     * Set jobTitle
     *
     * @param string $jobTitle
     * @return BJob
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
    
        return $this;
    }

    /**
     * Get jobTitle
     *
     * @return string 
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * Set jobDeadline
     *
     * @param string $jobDeadline
     * @return BJob
     */
    public function setJobDeadline($jobDeadline)
    {
        $this->jobDeadline = $jobDeadline;
    
        return $this;
    }

    /**
     * Get jobDeadline
     *
     * @return string 
     */
    public function getJobDeadline()
    {
        return $this->jobDeadline;
    }

    /**
     * Set jobDescription
     *
     * @param string $jobDescription
     * @return BJob
     */
    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;
    
        return $this;
    }

    /**
     * Get jobDescription
     *
     * @return string 
     */
    public function getJobDescription()
    {
        return $this->jobDescription;
    }

    /**
     * Set jcat
     *
     * @param \KJ\Entity\BJobcategory $jcat
     * @return BJob
     */
    public function setJcat(\KJ\Entity\BJobcategory $jcat = null)
    {
        $this->jcat = $jcat;
    
        return $this;
    }

    /**
     * Get jcat
     *
     * @return \KJ\Entity\BJobcategory 
     */
    public function getJcat()
    {
        return $this->jcat;
    }
}