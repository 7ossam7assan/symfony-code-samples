<?php

namespace WorkTimeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * WorkTime
 *
 * @ORM\Table(name="work_time")
 * @ORM\Entity(repositoryClass="WorkTimeBundle\Repository\WorkTimeRepository")
 */
class WorkTime
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

//
//    /**
//     *
//     * ORM\Column(name="day_name",type="string")
//     * @Assert\NotBlank()
//     * @Assert\Length(max=255)
//     */
//
//    private $dayName;


    /**
     *
     * @ORM\Column(name="day_name", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private  $dayName;

//    /**
//     *
//     * ORM\Column(name="time_from", type="string")
//     * @Assert\NotBlank()
//     * @Assert\Length(max=255)
//     */
//
//    private $timeFrom;

    /**
     *
     * @ORM\Column(name="time_from", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private  $timeFrom;


//    /**
//     *
//     * ORM\Column(name="time_to",type="string")
//     * @Assert\NotBlank()
//     * @Assert\Length(max=255)
//     */
//
//    private $timeTo;


    /**
     *
     * @ORM\Column(name="time_to", type="string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private  $timeTo;

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
     * @param mixed $dayName
     */
    public function setDayName($dayName)
    {
        $this->dayName = $dayName;
    }

    /**
     * @return mixed
     */
    public function getDayName()
    {
        return $this->dayName;
    }

    /**
     * @param mixed $timeFrom
     */
    public function setTimeFrom($timeFrom)
    {
        $this->timeFrom = $timeFrom;
    }

    /**
     * @return mixed
     */
    public function getTimeFrom()
    {
        return $this->timeFrom;
    }

    /**
     * @param mixed $timeTo
     */
    public function setTimeTo($timeTo)
    {
        $this->timeTo = $timeTo;
    }

    /**
     * @return mixed
     */
    public function getTimeTo()
    {
        return $this->timeTo;
    }

}

