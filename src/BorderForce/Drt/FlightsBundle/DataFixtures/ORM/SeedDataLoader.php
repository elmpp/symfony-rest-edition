<?php

namespace BorderForce\Drt\FlightsBundle\DataFixtures;

use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;
use Faker\Provider\DateTime;

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
    
    public function dateTimeBetweenRelative($startDate, $endDate) {
      $startTimestamp = $startDate instanceof \DateTime ? $startDate->getTimestamp() : strtotime($startDate);
      $endTimestamp = $endDate instanceof \DateTime ? $endDate->getTimestamp() : strtotime($endDate);
      $nowTimestamp = time();
      $startNowDiff = $startTimestamp - $nowTimestamp;
      $endTimestampComp = $endTimestamp + $startNowDiff;
      
      $rand = mt_rand(0, abs($endTimestampComp - $startTimestamp));
      $timestamp = $startTimestamp + $rand;
      
      $ts = new \DateTime('@' . $timestamp);
      $ts->setTimezone(new \DateTimeZone(date_default_timezone_get()));
      return $ts;
    }
    
    public function flightNumber($origin) {
      return substr($origin, 0, 3) . '123456789';
    }
}