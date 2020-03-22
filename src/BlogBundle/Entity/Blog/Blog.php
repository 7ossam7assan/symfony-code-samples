<?php

namespace BlogBundle\Entity\Blog;

use BlogBundle\Entity\Category\Category;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Blog
 *
 * @ORM\Table(name="blog")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\Blog\BlogRepository")
 */
class Blog
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
     * @ORM\Column(name="title", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     *
     */

    private $title;

    /**
     * @ORM\Column(name="description", type="text")
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(name="short_desc", type="text", nullable=true)
     */
    private $shortDesc;

    /**
     * @ORM\Column(name="type", type="string")
     * @Assert\NotBlank()
     *
     */

    private $type;

    /**
     * @ORM\Column(name="num_of_views", type="integer", options={"default":0})
     *
     */

    private $numOfViews;

    /**
     *
     * @ORM\Column(name="photo", type="string")
     * @Assert\NotBlank()
     * @Assert\Image(maxSize="1000000")
     * @Assert\Length(max=255)
     */

    private $photo;

    /**
     *
     * @ORM\Column(name="tags", type="text", nullable=true)
     */

    private  $tags;

    /**
     *
     * @ORM\Column(name="slug", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     *
     */

    private $slug;


    /**
     * @ORM\ManyToMany(targetEntity="BlogBundle\Entity\Category\Category", inversedBy="blogs")
     * @ORM\JoinTable(name="blogs_categories")
     */

    private $categories;

    /**
     * @ORM\Column(name="meta_title",type="string" , nullable=true)
     * @Assert\Length(max=255)
     *
     */


    /**
     * @param mixed $categories
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;
    }

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
     * @return mixed
     */
    /**
     * @return mixed
     */
    public function getShortDesc()
    {
        return $this->shortDesc;
    }
    /**
     * @param mixed $short_desc
     */
    /**
     * @param mixed $shortDesc
     */
    public function setShortDesc($shortDesc)
    {
        $this->shortDesc = $shortDesc;
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
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $tags
     */
    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    /**
     * @return mixed
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param mixed $num_of_views
     */
    /**
     * @param mixed $numOfViews
     */
    public function setNumOfViews($numOfViews)
    {
        $this->numOfViews = $numOfViews;
    }

    /**
     * @return mixed
     */
    /**
     * @return mixed
     */
    public function getNumOfViews()
    {
        return $this->numOfViews;
    }

    /**
     * @param mixed $categories
     */
    public function addCategories(Category $categories)
    {
        $categories->addBlogs($this); // synchronously updating inverse side
        $this->categories[] = $categories;
    }

    /**
     * @return mixed
     */
    public function getCategories()
    {
        return $this->categories;
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Blog constructor.
     */
    public function __construct()
    {
        $this->categories = new ArrayCollection();

    }


    public function __toString()
    {
        return $this->title;
    }


}

