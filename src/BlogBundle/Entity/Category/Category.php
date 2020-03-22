<?php

namespace BlogBundle\Entity\Category;

use BlogBundle\Entity\Blog\Blog;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="blog_category")
 * @ORM\Entity(repositoryClass="BlogBundle\Repository\Category\CategoryRepository")
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
     * @ORM\Column(name="title", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private $title;

    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     *
     */
    private  $description;

    /**
     * @ORM\Column(name="photo", type="string", nullable=true)
     * @Assert\Image(maxSize="1000000")
     */

    private $photo;


    /**
     * @ORM\Column(name="slug", type="string")
     * @Assert\NotBlank()
     * Assert\Length(max=255)
     *
     */
    private $slug;


    /**
     * @ORM\Column(name="meta_title",type="string" , nullable=true)
     * @Assert\Length(max=255)
     *
     */
    private $metaTitle;

    //id is one may be with many parent_id
    /**
     * One Category has Many Categories.
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Category\Category", mappedBy="parent")
     */


    private $children;


    /**
     * @return mixed
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Many Categories have One Category.
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\Category\Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL" )
     */
    private $parent;


    /**
     * @param mixed $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }


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
     * @ORM\ManyToMany(targetEntity="BlogBundle\Entity\Blog\Blog", mappedBy="categories")
     */

    private $blogs;
    /**
     * Category constructor.
     *
     */

    public function __construct()
    {
        $this->blogs = new ArrayCollection();
        $this->parent = new ArrayCollection();
        $this->children = new ArrayCollection();

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
     * @param mixed $blog
     */
    public function addBlogs(Blog $blog)
    {
        $blog->addCategories($this); // synchronously updating inverse side
        $this->blogs[] = $blog;
    }
    /**
     * @return mixed
     */
    public function getBlogs()
    {
        return $this->blogs;
    }

    public function __toString()
    {
        return $this->title;
    }


}

