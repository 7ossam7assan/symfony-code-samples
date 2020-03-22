<?php

namespace ServiceBundle\Entity\Service;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Service
 *
 * @ORM\Table(name="service")
 * @ORM\Entity(repositoryClass="ServiceBundle\Repository\Service\ServiceRepository")
 */
class Service
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
     * @ORM\Column(name="title", type="string")
     * @Assert\Length(max=255)
     * @Assert\NotBlank()
     */

    private $title;

    /**
     *
     * @ORM\Column(name="photo", type="string",options={"default" : "default_project.jpg"})
     * @Assert\Image(maxSize="1000000")
     * @Assert\NotBlank()
     */



    private $photo;

    /**
     *
     * @ORM\Column(name="short_desc", type="text", nullable=true)
     *
     */

    private $shortDesc;
    /**
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     *
     */

    private $description;


    /**
     *
     * @ORM\ManyToOne(targetEntity="ServiceBundle\Entity\Category\Category" , inversedBy="service", cascade={"all"})
     *
     */

    private $category;




    /**
     *
     * @ORM\Column(name="slug", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */

    private  $slug;


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
     * @ORM\Column(name="featured",type="integer" , options={ "default": 0})
     *
     */

    private $featured;





    public function __toString()
    {
        return $this->title;

    }

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
     * @param mixed $shortDesc
     */
    public function setShortDesc($shortDesc)
    {
        $this->shortDesc = $shortDesc;
    }

    /**
     * @return mixed
     */
    public function getShortDesc()
    {
        return $this->shortDesc;
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
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
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
     * @param mixed $featured
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;
    }

    /**
     * @return mixed
     */
    public function getFeatured()
    {
        return $this->featured;
    }

}

