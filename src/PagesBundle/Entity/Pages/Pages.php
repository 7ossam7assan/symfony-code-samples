<?php

namespace PagesBundle\Entity\Pages;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pages
 *
 * @ORM\Table(name="pages")
 * @ORM\Entity(repositoryClass="PagesBundle\Repository\Pages\PagesRepository")
 */
class Pages
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
     * @ORM\Column(name="title",type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private $title;

    /**
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     *
     */

    private $content;

    /**
     * @ORM\Column(name="active", type="string", options={"default":"Not Active"})
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     *
     */
    private $active;




    /**
     *
     * @ORM\ManyToOne(targetEntity="PagesBundle\Entity\Categories\Category" , inversedBy="pages")
     *
     */



    private $category;




    /**
     *
     * @ORM\Column(name="slug", type="string",nullable=true)
     * @Assert\Length(max=255)
     */

    private $slug;

    /**
     *
     * @ORM\Column(name="photo", type="string",nullable=true)
     *
     * @Assert\Image(maxSize="1000000")
     */

        private $photo;


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
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
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
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }


}

