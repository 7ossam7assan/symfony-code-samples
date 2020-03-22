<?php

namespace ContactBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="ContactBundle\Repository\ContactRepository")
 */
class Contact
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
     * @ORM\Column(name="name", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=256)
     */

    private $name;
    /**
     * @ORM\Column(name="email", type="string")
     * @Assert\NotBlank()
     * @Assert\Email(message="this is '{{ value }}' not a valid email" , checkMX = true)
     */

    private $email;


    /**
     * @ORM\Column(name="subject", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=256)
     */

    private $subject;


    /**
     * @ORM\Column(name="phone", type="string")
     * @Assert\Length(max=256)
     */

    private $phone;

    /**
     * @ORM\Column(name="message", type="text")
     * @Assert\NotBlank()
     */

    private $message;


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
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
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
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }


    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
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
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

}

