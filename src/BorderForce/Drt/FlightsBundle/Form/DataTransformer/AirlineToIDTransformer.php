<?php

namespace BorderForce\Drt\FlightsBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use BorderForce\Drt\FlightsBundle\Entity\Flight;

class AirlineToIDTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
     * Transforms an object (airline) to a string (number).
     *
     * @param  Issue|null $airline
     * @return string
     */
    public function transform($airline)
    {
        if (null === $airline) {
            return "";
        }

        return $airline->getId();
    }

    /**
     * Transforms a string (number) to an object (airline).
     *
     * @param  string $number
     *
     * @return Issue|null
     *
     * @throws TransformationFailedException if object (airline) is not found.
     */
    public function reverseTransform($numberOrName)
    {
        if (!$numberOrName) {
            return null;
        }

        $query = $this->om->createQuery(
          'select a from BorderForceDrtFlightsBundle:Airline a
           where a.id = :numberOrName or a.name = :numberOrName')
          ->setParameter('numberOrName', $numberOrName);
        try {
          $airline = $query->getSingleResult();
        } 
        catch (\Doctrine\Orm\NoResultException $e) {
          throw new TransformationFailedException(sprintf(
            'An airline with ID or name "%s" does not exist!',
            $numberOrName
          ));
        }

        return $airline;
    }

}