<?php

namespace KJ\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BJobcagtegory
 *
 * @ORM\Table(name="b_jobcagtegory")
 * @ORM\Entity
 */
class BJobcagtegory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="jcat_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $jcatId;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="KJ\Entity\BSubject", inversedBy="jcat")
     * @ORM\JoinTable(name="b_percentage",
     *   joinColumns={
     *     @ORM\JoinColumn(name="jcat_id", referencedColumnName="jcat_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="sub_id", referencedColumnName="sub_id")
     *   }
     * )
     */
    private $sub;

    /**
     * @var \KJ\Entity\ACompany
     *
     * @ORM\ManyToOne(targetEntity="KJ\Entity\ACompany")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="com_id", referencedColumnName="com_id")
     * })
     */
    private $com;

    /**
     * @var \KJ\Entity\BCategory
     *
     * @ORM\ManyToOne(targetEntity="KJ\Entity\BCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cat_id", referencedColumnName="cat_id")
     * })
     */
    private $cat;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sub = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get jcatId
     *
     * @return integer 
     */
    public function getJcatId()
    {
        return $this->jcatId;
    }

    /**
     * Add sub
     *
     * @param \KJ\Entity\BSubject $sub
     * @return BJobcagtegory
     */
    public function addSub(\KJ\Entity\BSubject $sub)
    {
        $this->sub[] = $sub;
    
        return $this;
    }

    /**
     * Remove sub
     *
     * @param \KJ\Entity\BSubject $sub
     */
    public function removeSub(\KJ\Entity\BSubject $sub)
    {
        $this->sub->removeElement($sub);
    }

    /**
     * Get sub
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSub()
    {
        return $this->sub;
    }

    /**
     * Set com
     *
     * @param \KJ\Entity\ACompany $com
     * @return BJobcagtegory
     */
    public function setCom(\KJ\Entity\ACompany $com = null)
    {
        $this->com = $com;
    
        return $this;
    }

    /**
     * Get com
     *
     * @return \KJ\Entity\ACompany 
     */
    public function getCom()
    {
        return $this->com;
    }

    /**
     * Set cat
     *
     * @param \KJ\Entity\BCategory $cat
     * @return BJobcagtegory
     */
    public function setCat(\KJ\Entity\BCategory $cat = null)
    {
        $this->cat = $cat;
    
        return $this;
    }

    /**
     * Get cat
     *
     * @return \KJ\Entity\BCategory 
     */
    public function getCat()
    {
        return $this->cat;
    }
}