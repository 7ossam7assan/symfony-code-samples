<?php

namespace TestimonialBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Testimonial
 *
 * @ORM\Table(name="testimonial")
 * @ORM\Entity(repositoryClass="TestimonialBundle\Repository\TestimonialRepository")
 */
class Testimonial
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
     * @ORM\Column(name="description",type="text")
     * @Assert\NotBlank()
     *
     */
    private $description;

    /**
     *
     * @ORM\Column(name="customer_position",type="text")
     * @Assert\NotBlank()
     *
     */
    private $customerPosition;



    /**
     *
     * @ORM\Column(name="customer_name",type="string")
     * @Assert\Length(max=255)
     */


    private $customerName;

    /**
     *
     * @ORM\Column(name="customer_photo", type="string" , nullable=true)
     * @Assert\Image(maxSize="1000000")
     */

    private $customerPhoto;


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
     * @param mixed $customer_position
     */


    /**
     * @param mixed $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @return mixed
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param mixed $customerPosition
     */
    public function setCustomerPosition($customerPosition)
    {
        $this->customerPosition = $customerPosition;
    }

    /**
     * @return mixed
     */
    public function getCustomerPosition()
    {
        return $this->customerPosition;
    }

    /**
     * @param mixed $customerPhoto
     */
    public function setCustomerPhoto($customerPhoto)
    {
        $this->customerPhoto = $customerPhoto;
    }

    /**
     * @return mixed
     */
    public function getCustomerPhoto()
    {
        return $this->customerPhoto;
    }

}

