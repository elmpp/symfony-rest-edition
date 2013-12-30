<?php

namespace BorderForce\Drt\FlightsBundle\Controller;

//use Acme\DemoBundle\Form\NoteType;
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
//        $notes = $session->get(self::SESSION_CONTEXT_NOTE, array());
//        $notes = array_slice($notes, $start, $limit, true);

        return $flights;
//        return new NoteCollection($notes, $offset, $limit);
    }

}
