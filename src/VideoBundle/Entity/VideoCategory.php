<?php

namespace VideoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * VideoCategory
 *
 * @ORM\Table(name="video_category")
 * @ORM\Entity(repositoryClass="VideoBundle\Repository\VideoCategoryRepository")
 */
class VideoCategory
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;


    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;


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
     *
     * @ORM\OneToMany(targetEntity="VideoCategory" ,mappedBy="category")
     *
     */

    private $video;


    /**
     * Set title
     *
     * @param string $title
     *
     * @return VideoCategory
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {

        return $this->title;

    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return VideoCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $video
     */
    public function setVideo($video)
    {
        $this->video = $video;
    }

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    public function __construct()
    {
        $this->video = new ArrayCollection();
    }
}

