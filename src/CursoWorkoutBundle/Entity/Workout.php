<?php

namespace CursoWorkoutBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Workout
 *
 * @ORM\Table(name="workout")
 * @ORM\Entity(repositoryClass="CursoWorkoutBundle\Repository\WorkoutRepository")
 */
class Workout
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
     * @ORM\Column(name="activity", type="string", length=255)
     */
    private $activity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ocurrenceDate", type="date")
     */
    private $ocurrenceDate;

    /**
     * @var float
     *
     * @ORM\Column(name="hours", type="float")
     */
    private $hours;    

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
     * Set activity
     *
     * @param string $activity
     *
     * @return Workout
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return string
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set ocurrenceDate
     *
     * @param \DateTime $ocurrenceDate
     *
     * @return Workout
     */
    public function setOcurrenceDate($ocurrenceDate)
    {
        $this->ocurrenceDate = $ocurrenceDate;

        return $this;
    }

    /**
     * Get ocurrenceDate
     *
     * @return \DateTime
     */
    public function getOcurrenceDate()
    {
        return $this->ocurrenceDate;
    }

    /**
     * Get hours
     * +
     * Set hours
     */    
    public function setHours($hours)
    {
    	$this->hours = $hours;
    }

    public function getHours()
    {
    	return $this->hours;
    }    
}

