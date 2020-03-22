<?php

namespace TeamBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Team
 *
 * @ORM\Table(name="team")
 * @ORM\Entity(repositoryClass="TeamBundle\Repository\TeamRepository")
 */
class Team
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
     */
    private  $title;

    /**
     *
     * @ORM\Column(name="job_title", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private  $jobTitle;

    /**
     *
     * @ORM\Column(name="place", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private  $place;


    /**
     *
     * @ORM\Column(name="email", type="string")
     * @Assert\NotBlank()
     * @Assert\Email(message="the Email '{{ value }}' is not a valid email")
     */
    private  $email;







    /**
     *
     * @ORM\Column(name="photo", type="string",options={"default" : "default_team.jpg"})
     * @Assert\NotBlank()
     * @Assert\Image()
     * @Assert\File(maxSize = "1000000")
     */
    private  $photo;


    /**
     *
     * @ORM\Column(name="phone", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private  $phone;



    /**
     *
     * @ORM\Column(name="slug", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private  $slug;







    /**
     *
     * @ORM\Column(name="fb_link", type="text",nullable=true)
     * @Assert\Url
     */
    private  $fbLink;

    /**
     *
     * @ORM\Column(name="youtube_link", type="text",nullable=true)
     * @Assert\Url
     */
    private  $youtubeLink;

    /**
     *
     * @ORM\Column(name="twitter_link", type="text",nullable=true)
     * @Assert\Url
     */
    private  $twitterLink;

    /**
     *
     * @ORM\Column(name="skype_link", type="text",nullable=true)
     *
     */
    private  $skypeLink;

    /**
     *
     * @ORM\Column(name="instagram_link", type="text",nullable=true)
     * @Assert\Url
     */
    private  $instagramLink;


//SEO cols


    /**
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     *
     */

    private $description;

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
     * @param mixed $jobTitle
     */
    public function setJobTitle($jobTitle)
    {
        $this->jobTitle = $jobTitle;
    }

    /**
     * @return mixed
     */
    public function getJobTitle()
    {
        return $this->jobTitle;
    }

    /**
     * @param mixed $place
     */
    public function setPlace($place)
    {
        $this->place = $place;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return $this->place;
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
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
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
     * @param mixed $fbLink
     */
    public function setFbLink($fbLink)
    {
        $this->fbLink = $fbLink;
    }

    /**
     * @return mixed
     */
    public function getFbLink()
    {
        return $this->fbLink;
    }

    /**
     * @param mixed $twitterLink
     */
    public function setTwitterLink($twitterLink)
    {
        $this->twitterLink = $twitterLink;
    }

    /**
     * @return mixed
     */
    public function getYoutubeLink()
    {
        return $this->youtubeLink;
    }

    /**
     * @param mixed $instagramLink
     */
    public function setInstagramLink($instagramLink)
    {
        $this->instagramLink = $instagramLink;
    }

    /**
     * @return mixed
     */
    public function getInstagramLink()
    {
        return $this->instagramLink;
    }

    /**
     * @param mixed $youtubeLink
     */
    public function setYoutubeLink($youtubeLink)
    {
        $this->youtubeLink = $youtubeLink;
    }

    /**
     * @return mixed
     */
    public function getTwitterLink()
    {
        return $this->twitterLink;
    }

    /**
     * @param mixed $skypeLink
     */
    public function setSkypeLink($skypeLink)
    {
        $this->skypeLink = $skypeLink;
    }

    /**
     * @return mixed
     */
    public function getSkypeLink()
    {
        return $this->skypeLink;
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

