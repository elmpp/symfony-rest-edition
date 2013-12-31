<?php

namespace BorderForce\Drt\FlightsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Flight
 */
class Flight
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $flightNumber;

    /**
     * @var string
     */
    private $from;

    /**
     * @var \DateTime
     */
    private $touchdownEstimated;

    /**
     * @var \DateTime
     */
    private $touchdown;

    /**
     * @var \DateTime
     */
    private $choxEstimated;

    /**
     * @var \DateTime
     */
    private $chox;

    /**
     * @var integer
     */
    private $passengers;

    /**
     * @var \BorderForce\Drt\FlightsBundle\Entity\Airline
     */
    private $airline;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set flightNumber
     *
     * @param string $flightNumber
     * @return Flight
     */
    public function setFlightNumber($flightNumber)
    {
        $this->flightNumber = $flightNumber;

        return $this;
    }

    /**
     * Get flightNumber
     *
     * @return string 
     */
    public function getFlightNumber()
    {
        return $this->flightNumber;
    }

    /**
     * Set from
     *
     * @param string $from
     * @return Flight
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return string 
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set touchdownEstimated
     *
     * @param \DateTime $touchdownEstimated
     * @return Flight
     */
    public function setTouchdownEstimated($touchdownEstimated)
    {
        $this->touchdownEstimated = $touchdownEstimated;

        return $this;
    }

    /**
     * Get touchdownEstimated
     *
     * @return \DateTime 
     */
    public function getTouchdownEstimated()
    {
        return $this->touchdownEstimated;
    }

    /**
     * Set touchdown
     *
     * @param \DateTime $touchdown
     * @return Flight
     */
    public function setTouchdown($touchdown)
    {
        $this->touchdown = $touchdown;

        return $this;
    }

    /**
     * Get touchdown
     *
     * @return \DateTime 
     */
    public function getTouchdown()
    {
        return $this->touchdown;
    }

    /**
     * Set choxEstimated
     *
     * @param \DateTime $choxEstimated
     * @return Flight
     */
    public function setChoxEstimated($choxEstimated)
    {
        $this->choxEstimated = $choxEstimated;

        return $this;
    }

    /**
     * Get choxEstimated
     *
     * @return \DateTime 
     */
    public function getChoxEstimated()
    {
        return $this->choxEstimated;
    }

    /**
     * Set chox
     *
     * @param \DateTime $chox
     * @return Flight
     */
    public function setChox($chox)
    {
        $this->chox = $chox;

        return $this;
    }

    /**
     * Get chox
     *
     * @return \DateTime 
     */
    public function getChox()
    {
        return $this->chox;
    }

    /**
     * Set passengers
     *
     * @param integer $passengers
     * @return Flight
     */
    public function setPassengers($passengers)
    {
        $this->passengers = $passengers;

        return $this;
    }

    /**
     * Get passengers
     *
     * @return integer 
     */
    public function getPassengers()
    {
        return $this->passengers;
    }

    /**
     * Set airline
     *
     * @param \BorderForce\Drt\FlightsBundle\Entity\Airline $airline
     * @return Flight
     */
    public function setAirline(\BorderForce\Drt\FlightsBundle\Entity\Airline $airline = null)
    {
        $this->airline = $airline;

        return $this;
    }

    /**
     * Get airline
     *
     * @return \BorderForce\Drt\FlightsBundle\Entity\Airline 
     */
    public function getAirline()
    {
        return $this->airline;
    }
    /**
     * @var string
     */
    private $origin;


    /**
     * Set origin
     *
     * @param string $origin
     * @return Flight
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return string 
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set id
     *
     * @param string $id
     * @return Flight
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
