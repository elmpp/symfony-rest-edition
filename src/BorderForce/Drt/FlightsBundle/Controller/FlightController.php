<?php

namespace BorderForce\Drt\FlightsBundle\Controller;

use BorderForce\Drt\FlightsBundle\Form\FlightType;
//use Acme\DemoBundle\Model\Note;
//use Acme\DemoBundle\Model\NoteCollection;

use FOS\RestBundle\Util\Codes;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\RouteRedirectView;

use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Rest controller for flights
 *
 * @package BorderForce\Drt\FlightsBundle\Controller
 * @author Matt Penrice
 */
class FlightController extends FOSRestController
{

    /**
     * List all flights.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing flights.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="5", description="How many flights to return.")
     *
     * @Annotations\View()
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getFlightsAction(Request $request, ParamFetcherInterface $paramFetcher)
    {

        $offset = $paramFetcher->get('offset');
        $start = null == $offset ? 0 : $offset + 1;
        $limit = $paramFetcher->get('limit');

        $flights = $this->getDoctrine()->getRepository('BorderForceDrtFlightsBundle:Flight')
          ->findAll();

        return $flights;
    }
    
    /**
     * Update existing flight from the submitted data or create a new flight at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\DemoBundle\Form\NoteType",
     *   statusCodes = {
     *     201 = "Returned when a new resource is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors",
     *   }
     * )
     *
     * @Annotations\View(
     *   template="BorderForceDrtFlightsBundle:flight:editFlight.html.twig",
     *   templateVar="form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the flightnumber id
     *
     * @return FormTypeInterface|RouteRedirectView
     *
     * @throws NotFoundHttpException when flight not exist
     */
    public function putFlightAction(Request $request, $id)
    {
        // Does the flight exist?
        $em       = $this->getDoctrine()->getManager();
        $existant = $em->getRepository('BorderForceDrtFlightsBundle:Flight')
          ->find($id);
        
        if ($existant) {
          $flight = $existant;
          $statusCode = Codes::HTTP_NO_CONTENT;
        }
        else {
          $flight = new \BorderForce\Drt\FlightsBundle\Entity\Flight;
          $flight->setId($id);
          $statusCode = Codes::HTTP_CREATED;
        }

        $form = $this->createForm(new FlightType(), $flight);
//        $form->submit($request);
        $form->handleRequest($request);
        if ($form->isValid()) {
          $data = $form->getData();
//$this->container->get('logger')->debug(\Doctrine\Common\Util\Debug::dump($data));
//\Doctrine\Common\Util\Debug::dump($data);
//var_dump($request->request->all());
//var_dump($id);
          $em->persist($flight);
          $em->flush();
          return $this->routeRedirectView('get_flights', array(), $statusCode);
        }

        return $form;
    }
    
}
