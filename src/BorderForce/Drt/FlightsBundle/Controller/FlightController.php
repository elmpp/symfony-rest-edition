<?php

namespace BorderForce\Drt\FlightsBundle\Controller;

use BorderForce\Drt\FlightsBundle\Form\FlightType;
use BorderForce\Drt\FlightsBundle\Entity\Flight;

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
     * Update existing flight from the submitted data
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
        $em          = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('BorderForceDrtFlightsBundle:Flight');
        $existant    = $repository
          ->find($id);
        
        if ($existant) {
          $flight = $existant;
          $statusCode = Codes::HTTP_NO_CONTENT;
        }
        else {
          return $this->routeRedirectView('get_flights', array(), Codes::HTTP_UNPROCESSABLE_ENTITY);
          die;
        }

        $form = $this->createForm(new FlightType(), $flight, array(
          'em' => $this->getDoctrine()->getManager()
        ));
        $form->submit($request);
//        $form->handleRequest($request);
        if ($form->isValid()) {
          $data = $form->getData();
//$this->container->get('logger')->debug(\Doctrine\Common\Util\Debug::dump($data));
//\Doctrine\Common\Util\Debug::dump($data);
//var_dump($request->request->all());
//var_dump($id);
          $em->persist($flight);
          $em->flush();
          return $this->routeRedirectView('get_flight', array('id' => $data->getId()), $statusCode);
        }
        else {
          var_dump($form->getErrorsAsString()); die;
        }

        return $form;
    }
    
    /**
     * Presents the form to use to create a new flight.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @return FormTypeInterface
     */
    public function newFlightAction()
    {
        return $this->createForm(new FlightType(), new Flight, array('em' => $this->getDoctrine()->getManager()));
    }
    
    /**
     * Creates a new flight from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "BorderForce\Drt\FlightsBundle\Form\FlightType",
     *   statusCodes = {
     *     201 = "Returned when new resource created successfully",
     *     409 = "Returned when resource existing"
     *   }
     * )
     *
     * @Annotations\View(
     *   template = "BorderForceDrtFlightsBundle:Flight:newFlight.html.twig",
     *   statusCode = Codes::HTTP_BAD_REQUEST
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|RouteRedirectView
     */
    public function postFlightsAction(Request $request)
    {
      $em       = $this->getDoctrine()->getManager();
//      $existant = $em->getRepository('BorderForceDrtFlightsBundle:Flight')
//        ->find($id);
      $flight = new Flight();
//      $flight->setId(substr($request->get('origin'), 0, 3) . '123456789');
      $form = $this->createForm(new FlightType(), $flight, array('em' => $this->getDoctrine()->getManager()));

      $form->submit($request);
      $data = $form->getData();
      
      if ($form->isValid()) {
        $em->persist($flight);
        $em->flush();
          return $this->routeRedirectView('get_flights');
      }
      // If the validation failed due to existing resource, do our restful redirect
      else {
        $uniqueErrors = $form->getErrors();
        if (count($uniqueErrors ===1 && stripos($uniqueErrors[0]->getMessage(), 'already exists'))) {
          
          $existing = $this->getDoctrine()->getRepository('BorderForceDrtFlightsBundle:Flight')
            ->findByFlightNumberAndScheduledDate($data->getFlightNumber(), $data->getScheduledDate());
          return $this->routeRedirectView('get_flight', array('id' => $existing->getId()), Codes::HTTP_CONFLICT);
        }
      }

      return array(
          'form' => $form
      );
    }
    
    /**
     * Get a single flight.
     *
     * @ApiDoc(
     *   output = "BorderForce\Drt\FlightsBundle\Model\Note",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the flight is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="flight")
     *
     * @param Request $request the request object
     * @param int     $id      the flight id
     *
     * @return array
     *
     * @throws NotFoundHttpException when flight not exist
     */
    public function getFlightAction(Request $request, $id)
    {
      $flight = $this->getDoctrine()->getRepository('BorderForceDrtFlightsBundle:Flight')
        ->find($id);
      if (!$flight) {
        throw $this->createNotFoundException("Flight does not exist.");
      }

      $view = new View($flight);
//      $view->getSerializationContext()->setGroups(array('Default', $group));

      return $view;
    }
    
}
