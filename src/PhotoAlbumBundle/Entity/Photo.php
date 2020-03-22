<?php

namespace PhotoAlbumBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="PhotoAlbumBundle\Repository\PhotoRepository")
 */
class Photo
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
     * @Assert\Length(max=256)
     * @Assert\NotBlank()
     */

    private  $title;


    /**
     *
     * @ORM\Column(name="photo", type="string",options={"default" : "default_photo.jpg"})
     * @Assert\Image(maxSize="1000000")
     * @Assert\NotBlank()
     */


    private $photo;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Category" , inversedBy="photos")
     */

    private  $category;


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
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

}

