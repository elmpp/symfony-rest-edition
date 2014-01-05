<?php

namespace BorderForce\Drt\FlightsBundle\Tests\Controller;

use BorderForce\Drt\FlightsBundle\Lib\Test\WebDoctrineTestCase;


class FlightControllerTest extends WebDoctrineTestCase {
  
  public function testGetFlightsJson() {
    
    $client = static::$client;

    $client->request('HEAD', '/flights.json');
    $response = $client->getResponse();
    $this->assertEquals(200, $response->getStatusCode(), $response->getContent());

    $client->request('GET', '/flights.json');
    $response = $client->getResponse();
    $contentJson  = $response->getContent();
    $content = json_decode($contentJson, true);
    $this->assertEquals(count($content), 6);
    $this->assertTrue(isset($content[0]['airline']));
  }
  
  public function stestGetFlightsHtml() {

    $client = static::$client;
    
    $crawler  = $client->request(
      'GET', 
      '/flights', 
      array(), 
      array(), 
      array('CONTENT_TYPE' => 'text/html')
    );
    $response = $client->getResponse();
    $this->assertTrue(
      $client->getResponse()->headers->contains(
        'content-type',
        'text/html; charset=UTF-8'
      )
    );
    $this->assertCount(7, $crawler->filter('ul#flight-list li'));
  }
  
  
  public function testPutFlight() {
//$this->expectOutputString(''); // tell PHPUnit to expect '' as output

    $client     = static::$client;
    
    $manchesterFlight = $this->getFlightByOrigin($client, 'manchester');
    $this->assertNotNull($manchesterFlight);

    $putFlightExisting = $client->request(
      'PUT', 
      '/flights/' . $manchesterFlight['id'] . '.json', 
      array(), 
      array(), 
      array('CONTENT_TYPE' => 'application/json'),
      $this->getFlightJsonEntry('notmanchester')
    );
    $this->assertEquals(\FOS\RestBundle\Util\Codes::HTTP_NO_CONTENT, $client->getResponse()->getStatusCode());
    
    $notmanchesterFlight = $this->getFlightByOrigin($client, 'notmanchester');
    $this->assertNotNull($notmanchesterFlight, 'has manchester record been updated');
    
    // currently not supporting creating entities at a given id due to db id generation probs..
    $newJson = $this->getFlightJsonEntry('newlocation');
    $putFlightNew = $client->request(
      'PUT', 
      '/flights/100787653.json', //unused ID 
      array(), 
      array(), 
      array('CONTENT_TYPE' => 'application/json'),
      $newJson
    );
    $this->assertEquals(\FOS\RestBundle\Util\Codes::HTTP_UNPROCESSABLE_ENTITY, $client->getResponse()->getStatusCode());
//    $this->assertTrue($client->getResponse()->isRedirect()); // no way to get the Location header, stupidly
    
    $this->loadFixtures(); // as test data has been changed, reload
  }
  
  protected function getFlightByOrigin($client, $origin) {
    $allFlightsCrawler  = $client->request(
      'GET', 
      '/flights.json',
      array(), 
      array(), 
      array('CONTENT_TYPE' => 'application/json')
    );
    $allFlights = json_decode($client->getResponse()->getContent(), true);      
    $flight = null;
    foreach ($allFlights as $aFlight) {
      if ($aFlight['origin'] == $origin) {
        $flight = $aFlight;
      }
    }
    return $flight;
  }

  protected function getFlightJsonEntry($place = 'sydney') {
    $search = array('sydney', 'syd');
    $replace = array($place, substr($place, 0, 3));
    $fileContent = file_get_contents(static::$application->getKernel()->getRootDir() . '/../flight.json');
    return str_replace($search, $replace, $fileContent);
  }
}

