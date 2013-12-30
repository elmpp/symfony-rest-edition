<?php

namespace BorderForce\Drt\FlightsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ForecastFlight
 */
class ForecastFlight
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $code;


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
     * Set name
     *
     * @param string $name
     * @return ForecastFlight
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return ForecastFlight
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * @var string
     */
    private $test;


    /**
     * Set test
     *
     * @param string $test
     * @return ForecastFlight
     */
    public function setTest($test)
    {
        $this->test = $test;

        return $this;
    }

    /**
     * Get test
     *
     * @return string 
     */
    public function getTest()
    {
        return $this->test;
    }
    /**
     * @var \BorderForce\Drt\FlightsBundle\Entity\Airline
     */
    private $forecastFlight;


    /**
     * Set forecastFlight
     *
     * @param \BorderForce\Drt\FlightsBundle\Entity\Airline $forecastFlight
     * @return ForecastFlight
     */
    public function setForecastFlight(\BorderForce\Drt\FlightsBundle\Entity\Airline $forecastFlight = null)
    {
        $this->forecastFlight = $forecastFlight;

        return $this;
    }

    /**
     * Get forecastFlight
     *
     * @return \BorderForce\Drt\FlightsBundle\Entity\Airline 
     */
    public function getForecastFlight()
    {
        return $this->forecastFlight;
    }
    /**
     * @var \BorderForce\Drt\FlightsBundle\Entity\Airline
     */
    private $airline;


    /**
     * Set airline
     *
     * @param \BorderForce\Drt\FlightsBundle\Entity\Airline $airline
     * @return ForecastFlight
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
}
