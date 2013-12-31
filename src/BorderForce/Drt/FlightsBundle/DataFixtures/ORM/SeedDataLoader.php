<?php

namespace BorderForce\Drt\FlightsBundle\DataFixtures;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

class SeedDataLoader extends DataFixtureLoader
{
    /**
     * {@inheritDoc}
     */
    protected function getFixtures()
    {

      if ($this->container->getParameter('kernel.environment') == 'test') {
        return  array(
          __DIR__ . '/seed_test.yml',
        );
      }
      else {
        return  array(
          __DIR__ . '/seed.yml',
        );
      }
        
    }
    
    public function dateTimeAt($dateTimeString) {
      return new \DateTime($dateTimeString);
    }
}