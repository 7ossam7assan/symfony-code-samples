<?php

namespace ProjectBundle\Entity\Categories;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\Category\CategoryRepository")
 */
class Category
{
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
     * @ORM\Column(name="title",type="string")
     * @Assert\Length(max=255)
     * @Assert\NotBlank()
     */

    private $title;

    /**
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     *
     */

    private $description;

    /**
     *
     * @ORM\Column(name="photo",type="string", options={ "default": "default_category.jpg"})
     * @Assert\Image(maxSize="1000000")
     */

    private $photo;


    /**
     *
     * @ORM\OneToMany(targetEntity="ProjectBundle\Entity\Projects\Project" ,mappedBy="category")
     *
     */

    private $project;


    /**
     * @ORM\Column(name="meta_title",type="text" , nullable=true)
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
     *
     * @ORM\Column(name="slug",type="text", nullable=true)
     *
     */

    private $slug;


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
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }


    /**
     * @param mixed $project
     */
    public function setProject($project)
    {
        $this->project = $project;
    }

    /**
     * @return mixed
     */


    public function __construct()
    {
        $this->project = new ArrayCollection();

    }



    /**
     * @return mixed
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * @param mixed $metaTitle
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;
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

    /**
     * @return mixed
     */




    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return mixed
     */
    public function getProject()
    {
        return $this->project;
    }

    public function __toString()
    {
        return $this->title;
    }


}

