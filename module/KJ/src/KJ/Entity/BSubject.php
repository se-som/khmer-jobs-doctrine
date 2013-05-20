<?php

namespace KJ\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BSubject
 *
 * @ORM\Table(name="b_subject")
 * @ORM\Entity
 */
class BSubject
{
    /**
     * @var integer
     *
     * @ORM\Column(name="sub_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $subId;

    /**
     * @var string
     *
     * @ORM\Column(name="sub_name", type="string", length=255, nullable=true)
     */
    private $subName;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="KJ\Entity\BCategory", mappedBy="sub")
     */
    private $cat;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="KJ\Entity\BJobcagtegory", mappedBy="sub")
     */
    private $jcat;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cat = new \Doctrine\Common\Collections\ArrayCollection();
        $this->jcat = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get subId
     *
     * @return integer 
     */
    public function getSubId()
    {
        return $this->subId;
    }

    /**
     * Set subName
     *
     * @param string $subName
     * @return BSubject
     */
    public function setSubName($subName)
    {
        $this->subName = $subName;
    
        return $this;
    }

    /**
     * Get subName
     *
     * @return string 
     */
    public function getSubName()
    {
        return $this->subName;
    }

    /**
     * Add cat
     *
     * @param \KJ\Entity\BCategory $cat
     * @return BSubject
     */
    public function addCat(\KJ\Entity\BCategory $cat)
    {
        $this->cat[] = $cat;
    
        return $this;
    }

    /**
     * Remove cat
     *
     * @param \KJ\Entity\BCategory $cat
     */
    public function removeCat(\KJ\Entity\BCategory $cat)
    {
        $this->cat->removeElement($cat);
    }

    /**
     * Get cat
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCat()
    {
        return $this->cat;
    }

    /**
     * Add jcat
     *
     * @param \KJ\Entity\BJobcagtegory $jcat
     * @return BSubject
     */
    public function addJcat(\KJ\Entity\BJobcagtegory $jcat)
    {
        $this->jcat[] = $jcat;
    
        return $this;
    }

    /**
     * Remove jcat
     *
     * @param \KJ\Entity\BJobcagtegory $jcat
     */
    public function removeJcat(\KJ\Entity\BJobcagtegory $jcat)
    {
        $this->jcat->removeElement($jcat);
    }

    /**
     * Get jcat
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getJcat()
    {
        return $this->jcat;
    }
}