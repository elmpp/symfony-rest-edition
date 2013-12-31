<?php

namespace BorderForce\Drt\FlightsBundle\Tests\Controller;

use BorderForce\Drt\FlightsBundle\Lib\Test\WebDoctrineTestCase;


class FlightControllerTest extends WebDoctrineTestCase {
  
  public function testGetFlights() {
    
    $client = self::createClient();
    $client->request('HEAD', '/flights.json');
    $response = $client->getResponse();
    $this->assertEquals(200, $response->getStatusCode(), $response->getContent());

    // empty list
    $client->request('GET', '/notes.json');
    $response = $client->getResponse();
  }
}

