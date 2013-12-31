<?php

namespace BorderForce\Drt\FlightsBundle\Tests\Controller;

use BorderForce\Drt\FlightsBundle\Lib\Test\WebDoctrineTestCase;


class FlightControllerTest extends WebDoctrineTestCase {
  
  public function sstestGetFlightsJson() {
    
    $client = self::createClient();

    $client->request('HEAD', '/flights.json');
    $response = $client->getResponse();
    $this->assertEquals(200, $response->getStatusCode(), $response->getContent());

    $client->request('GET', '/flights.json');
    $response = $client->getResponse();
    $this->assertEquals($client->getResponse()->getContent(), 
      '[{"id":"man123456789","touchdown_estimated":"2014-10-05T11:24:47+0100","touchdown":"2014-10-05T11:26:47+0100","chox_estimated":"2014-10-05T11:28:47+0100","chox":"2014-10-05T11:30:47+0100","passengers":500,"airline":{"id":1,"name":"British Airlines","colour":"White"},"origin":"manchester"},{"id":"lee123456789","touchdown_estimated":"2014-10-05T11:24:47+0100","touchdown":"2014-10-05T11:26:47+0100","chox_estimated":"2014-10-05T11:28:47+0100","chox":"2014-10-05T11:30:47+0100","passengers":400,"airline":{"id":1,"name":"British Airlines","colour":"White"},"origin":"leeds"},{"id":"dub123456789","touchdown_estimated":"2014-10-05T11:24:47+0100","touchdown":"2014-10-05T11:26:47+0100","chox_estimated":"2014-10-05T11:28:47+0100","chox":"2014-10-05T11:30:47+0100","passengers":300,"airline":{"id":2,"name":"Emirates","colour":"Red"},"origin":"dubai"},{"id":"kur123456789","touchdown_estimated":"2014-10-05T11:24:47+0100","touchdown":"2014-10-05T11:26:47+0100","chox_estimated":"2014-10-05T11:28:47+0100","chox":"2014-10-05T11:30:47+0100","passengers":200,"airline":{"id":2,"name":"Emirates","colour":"Red"},"origin":"kurachi"},{"id":"ams123456789","touchdown_estimated":"2014-10-05T11:24:47+0100","touchdown":"2014-10-05T11:26:47+0100","chox_estimated":"2014-10-05T11:28:47+0100","chox":"2014-10-05T11:30:47+0100","passengers":100,"airline":{"id":3,"name":"KLM","colour":"Orange"},"origin":"amsterdam"},{"id":"rot123456789","touchdown_estimated":"2014-10-05T11:24:47+0100","touchdown":"2014-10-05T11:26:47+0100","chox_estimated":"2014-10-05T11:28:47+0100","chox":"2014-10-05T11:30:47+0100","passengers":50,"airline":{"id":3,"name":"KLM","colour":"Orange"},"origin":"rotterdam"}]'
    );
  }
  
  public function sstestGetFlightsHtml() {

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
  
  
  public function testPutFlight() {
$this->expectOutputString(''); // tell PHPUnit to expect '' as output
    $flight = '[{"id":"syd123456789","touchdown_estimated":"2014-10-05T11:24:47+0100","touchdown":"2014-10-05T11:26:47+0100","chox_estimated":"2014-10-05T11:28:47+0100","chox":"2014-10-05T11:30:47+0100","passengers":500,"airline":1,"origin":"sydney"}]';
    $client   = self::createClient();
    $crawler  = $client->request('PUT', '/flights/syd123456789.json', array(), array(), array('CONTENT_TYPE' => 'application/json'),$flight);
    $response = $client->getResponse();
    $this->assertEquals(201, $response->getStatusCode(), $response->getContent());
var_dump($response->getContent());
  }
}

