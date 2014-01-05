<?php

namespace BorderForce\Drt\FlightsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FlightType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
      $entityManager = $options['em'];
      $transformer = new DataTransformer\AirlineToIDTransformer($entityManager);
      
      $builder
        ->add('flightNumber')
//        ->add('flightNumber', 'text', array('error_bubbling' => true))
        ->add('scheduledDate', 'date', array('widget' => 'single_text', 'format' => 'dd-MM-yyyy'))
        ->add('origin')
        ->add('touchdownEstimated', 'datetime', array('input' => 'datetime', 'widget' => 'single_text', 'date_format' => 'dd-MM-yyyy hh:mm'))
//            ->add('touchdownEstimated', 'datetime', array('input' => 'datetime', 'time_widget' => 'single_text', 'date_widget' => 'single_text', 'date_format' => 'yyyy-MM-dd'))
        ->add('touchdown', 'datetime', array('input' => 'datetime', 'widget' => 'single_text', 'date_format' => 'dd-MM-yyyy hh:mm'))
        ->add('choxEstimated', 'datetime', array('input' => 'datetime', 'widget' => 'single_text', 'date_format' => 'dd-MM-yyyy hh:mm'))
        ->add('chox', 'datetime', array('input' => 'datetime', 'widget' => 'single_text', 'date_format' => 'dd-MM-yyyy hh:mm'))
//            ->add('touchdown', 'datetime', array('time_widget' => 'single_text', 'date_widget' => 'single_text', 'date_format' => 'yyyy-MM-dd'))
//            ->add('choxEstimated', 'datetime', array('time_widget' => 'single_text', 'date_widget' => 'single_text', 'date_format' => 'yyyy-MM-dd'))
//            ->add('chox', 'datetime', array('time_widget' => 'single_text', 'date_widget' => 'single_text', 'date_format' => 'yyyy-MM-dd'))
        ->add('passengers')
        ->add(
//          $builder->create('airline', 'entity', array('class' => 'BorderForceDrtFlightsBundle:Airline', 'property' => 'name', 'empty_value' => ""))->addModelTransformer($transformer)
          $builder->create('airline', 'text', array())->addModelTransformer($transformer)
          )
//            ->add('flightNumber')
//            ->add('scheduledDate')
//            ->add('origin')
//            ->add('touchdownEstimated')
//            ->add('touchdown')
//            ->add('choxEstimated')
//            ->add('chox')
//            ->add('passengers')
//            ->add('airline')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
      $resolver->setDefaults(array(
        'data_class' => 'BorderForce\Drt\FlightsBundle\Entity\Flight',
        'csrf_protection' => false
      ))
      ->setRequired(array(
        'em',
      ))
      ->setAllowedTypes(array(
        'em' => 'Doctrine\Common\Persistence\ObjectManager',
      ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'flight';
    }
}
