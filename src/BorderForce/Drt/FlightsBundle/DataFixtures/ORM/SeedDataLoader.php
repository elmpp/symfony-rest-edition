<?php

namespace BorderForce\Drt\FlightsBundle\DataFixtures;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;

class TestLoader extends DataFixtureLoader
{
    /**
     * {@inheritDoc}
     */
    protected function getFixtures()
    {
      if ($this->container->get('http_kernel')->getEnvironment() == 'test') {
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
}