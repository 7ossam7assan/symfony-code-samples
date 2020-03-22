<?php

namespace PagesBundle\Entity\Categories;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="pages_category")
 * @ORM\Entity(repositoryClass="PagesBundle\Repository\Categories\CategoryRepository")
 */
class Category
{


    public function __construct()
    {
        $this->pages = new ArrayCollection();

    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     *
     * @ORM\Column(name="title", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     *
     */

    private $title;


    /**
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     *
     */

    private  $description;


    /**
     *
     * @ORM\OneToMany(targetEntity="PagesBundle\Entity\Pages\Pages",mappedBy="category",cascade={"all"})
     *
     */

    private $pages;

    /**
     * @ORM\Column(name="meta_title",type="string" , nullable=true)
     * @Assert\Length(max=255)
     *
     */

    private $metaTitle;

    /**
     * @ORM\Column(name="meta_description",type="text" , nullable=true)
     *
     */
    private $metaDescription;

    /**
     * @ORM\Column(name="meta_keywords",type="text" , nullable=true)
     *
     */

    private $metaKeywords;



    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $pages
     */
    public function setPages($pages)
    {
        $this->$pages = $pages;
    }

    /**
     * @return mixed
     */
    public function getPages()
    {
        return $this->pages;
    }


    /**
     * @param mixed $metaTitle
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
    }

    /**
     * @return mixed
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @param mixed $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param mixed $metaKeywords
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;
    }

    /**
     * @return mixed
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

}

