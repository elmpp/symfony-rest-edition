<?php

namespace BorderForce\Drt\FlightsBundle\Tests\Controller;

use BorderForce\Drt\FlightsBundle\Lib\Test\WebDoctrineTestCase;


class FlightControllerTest extends WebDoctrineTestCase {
  
  public function testGetFlightsJson() {
    
    $client = self::createClient();

    $client->request('HEAD', '/flights.json');
    $response = $client->getResponse();
    $this->assertEquals(200, $response->getStatusCode(), $response->getContent());

    $client->request('GET', '/flights.json');
    $response = $client->getResponse();
    $this->assertEquals($client->getResponse()->getContent(), 
      '[{"id":1,"flight_number":"man123456789","touchdown_estimated":"2014-10-05T11:24:47+0100","touchdown":"2014-10-05T11:26:47+0100","chox_estimated":"2014-10-05T11:28:47+0100","chox":"2014-10-05T11:30:47+0100","passengers":500,"airline":{"id":1,"name":"British Airlines","colour":"White"},"origin":"manchester"},{"id":2,"flight_number":"lee123456789","touchdown_estimated":"2014-10-05T11:24:47+0100","touchdown":"2014-10-05T11:26:47+0100","chox_estimated":"2014-10-05T11:28:47+0100","chox":"2014-10-05T11:30:47+0100","passengers":400,"airline":{"id":1,"name":"British Airlines","colour":"White"},"origin":"leeds"},{"id":3,"flight_number":"dub123456789","touchdown_estimated":"2014-10-05T11:24:47+0100","touchdown":"2014-10-05T11:26:47+0100","chox_estimated":"2014-10-05T11:28:47+0100","chox":"2014-10-05T11:30:47+0100","passengers":300,"airline":{"id":2,"name":"Emirates","colour":"Red"},"origin":"dubai"},{"id":4,"flight_number":"kur123456789","touchdown_estimated":"2014-10-05T11:24:47+0100","touchdown":"2014-10-05T11:26:47+0100","chox_estimated":"2014-10-05T11:28:47+0100","chox":"2014-10-05T11:30:47+0100","passengers":200,"airline":{"id":2,"name":"Emirates","colour":"Red"},"origin":"kurachi"},{"id":5,"flight_number":"ams123456789","touchdown_estimated":"2014-10-05T11:24:47+0100","touchdown":"2014-10-05T11:26:47+0100","chox_estimated":"2014-10-05T11:28:47+0100","chox":"2014-10-05T11:30:47+0100","passengers":100,"airline":{"id":3,"name":"KLM","colour":"Orange"},"origin":"amsterdam"},{"id":6,"flight_number":"rot123456789","touchdown_estimated":"2014-10-05T11:24:47+0100","touchdown":"2014-10-05T11:26:47+0100","chox_estimated":"2014-10-05T11:28:47+0100","chox":"2014-10-05T11:30:47+0100","passengers":50,"airline":{"id":3,"name":"KLM","colour":"Orange"},"origin":"rotterdam"}]'
    );
  }
  
  public function testGetFlightsHtml() {
//$this->expectOutputString(''); // tell PHPUnit to expect '' as output
    $client = self::createClient();
    
    $crawler  = $client->request('GET', '/flights', array(), array(), array('CONTENT_TYPE' => 'text/html'));
    $response = $client->getResponse();
    $this->assertTrue(
      $client->getResponse()->headers->contains(
        'content-type',
        'text/html; charset=UTF-8'
      )
    );
    $this->assertCount(7, $crawler->filter('ul#flight-list li'));
//var_dump($response->getContent());
//var_dump($response->headers);
  }
}

