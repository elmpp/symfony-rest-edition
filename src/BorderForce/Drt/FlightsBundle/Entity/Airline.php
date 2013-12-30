<?php

namespace BorderForce\Drt\FlightsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Airline
 */
class Airline
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
    private $colour;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $forecastFlights;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->forecastFlights = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Airline
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
     * Set colour
     *
     * @param string $colour
     * @return Airline
     */
    public function setColour($colour)
    {
        $this->colour = $colour;

        return $this;
    }

    /**
     * Get colour
     *
     * @return string 
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * Add forecastFlights
     *
     * @param \BorderForce\Drt\FlightsBundle\Entity\ForecastFlights $forecastFlights
     * @return Airline
     */
    public function addForecastFlight(\BorderForce\Drt\FlightsBundle\Entity\ForecastFlights $forecastFlights)
    {
        $this->forecastFlights[] = $forecastFlights;

        return $this;
    }

    /**
     * Remove forecastFlights
     *
     * @param \BorderForce\Drt\FlightsBundle\Entity\ForecastFlights $forecastFlights
     */
    public function removeForecastFlight(\BorderForce\Drt\FlightsBundle\Entity\ForecastFlights $forecastFlights)
    {
        $this->forecastFlights->removeElement($forecastFlights);
    }

    /**
     * Get forecastFlights
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getForecastFlights()
    {
        return $this->forecastFlights;
    }
}
