<?php

namespace KJ\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BCategory
 *
 * @ORM\Table(name="b_category")
 * @ORM\Entity
 */
class BCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="cat_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $catId;

    /**
     * @var string
     *
     * @ORM\Column(name="cat_name", type="string", length=255, nullable=true)
     */
    private $catName;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="KJ\Entity\BSubject", inversedBy="cat")
     * @ORM\JoinTable(name="b_cagtegory_subject",
     *   joinColumns={
     *     @ORM\JoinColumn(name="cat_id", referencedColumnName="cat_id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="sub_id", referencedColumnName="sub_id")
     *   }
     * )
     */
    private $sub;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sub = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Get catId
     *
     * @return integer 
     */
    public function getCatId()
    {
        return $this->catId;
    }

    /**
     * Set catName
     *
     * @param string $catName
     * @return BCategory
     */
    public function setCatName($catName)
    {
        $this->catName = $catName;
    
        return $this;
    }

    /**
     * Get catName
     *
     * @return string 
     */
    public function getCatName()
    {
        return $this->catName;
    }

    /**
     * Add sub
     *
     * @param \KJ\Entity\BSubject $sub
     * @return BCategory
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
}