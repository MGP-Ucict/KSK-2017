<?php
namespace Ucict\Bundle\StudentBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Doctrine\ORM\EntityRepository;
use Ucict\Bundle\StudentBundle\Entity\Region;
use Ucict\Bundle\StudentBundle\Entity\City;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;

class AddCityFieldSubscriber implements EventSubscriberInterface
{
    private $propertyPathToCity;

    private $city;
    
    
    

    public function __construct($propertyPathToCity, $city)
    {
        $this->propertyPathToCity = $propertyPathToCity;
       $this->city = $city;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA  => 'preSetData',
            FormEvents::PRE_SUBMIT    => 'preSubmit'
        );
    }

    private function addCityForm($form, $province_id)
    {
        
        $formOptions = array(
            'class'         => 'StudentBundle:City',
            //'empty_value'   => 'Изберете',
           'data'          => $this->city,
            'label'         => 'Населено място',
            'attr'          => array(
                'class' => 'city_selector',
            ),
             
            'query_builder' => function (EntityRepository $repository) use ($province_id) {
                $qb = $repository->createQueryBuilder('city')
                    ->innerJoin('city.region', 'region')
                    ->where('region.id = :id')
                    ->setParameter('id', $province_id)
                ;

                return $qb;
            }
        );

        $form->add('city',  EntityType::class, $formOptions);
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (null === $data) {
            return;
        }

        $accessor    = PropertyAccess::createPropertyAccessor();
        
        $city        = $accessor->getValue($data, $this->propertyPathToCity);
       $c = new City();
        //$c = $this->getDoctrine()->getRepository('StudentBundle:City')->findOneById($city);
        if($city){
        $c->setId($city);


    }
         var_dump($city);
        $province_id =  ($this->city && $this->city->getRegion())?$this->city->getRegion()->getId():null;
        //($city) ? $data->getRegion() :null;//$c->getRegion()->getId() : null;//$city->getRegion()->getId()

        $this->addCityForm($form, $province_id);
    }

    public function preSubmit(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        $province_id = array_key_exists('region', $data) ? $data['region'] : null;

        $this->addCityForm($form, $province_id);
    }
}