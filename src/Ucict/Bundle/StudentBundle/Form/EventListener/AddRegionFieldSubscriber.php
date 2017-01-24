<?php
namespace Ucict\Bundle\StudentBundle\Form\EventListener;
 use Ucict\Bundle\StudentBundle\Entity\City;
 use Ucict\Bundle\StudentBundle\Entity\Region;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class AddRegionFieldSubscriber implements EventSubscriberInterface
{
    private $propertyPathToCity;
   private $region;
 
    public function __construct($propertyPathToCity, $region)
    {
        $this->propertyPathToCity = $propertyPathToCity;
        $this->region = $region;
    }
 
    public static function getSubscribedEvents()
    {
        return array(
            FormEvents::PRE_SET_DATA => 'preSetData',
            FormEvents::PRE_SUBMIT   => 'preSubmit'
        );
    }
 
    private function addRegionForm($form, $region = null)
    { 
        
        $formOptions = array(
            'class'         => 'StudentBundle:Region',
            'mapped'        => false,
            'label'         => 'Регион',
            'data' => $this->region,//$region->getId(),
            //'empty_value'   => 'Изберете',
            'attr'          => array(
                'class' => 'region_selector',
            ),
        );
 
        if ($region) {
            $formOptions['data'] = $region;
        }
 
        $form->add('region',  EntityType::class, $formOptions);
    }
 
    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();
 
        if (null === $data) {
            return;
        }
        $accessorBuilder = PropertyAccess::createPropertyAccessorBuilder();
        $accessor = $accessorBuilder->getPropertyAccessor(); //PropertyAccess::getPropertyAccessor();
       
        $city    = $accessor->getValue($data, $this->propertyPathToCity);
        var_dump($city);
        //var_dump("city=".$city);
        //$city = $this->getDoctrine()->getRepository('StudentBundle:City')->findOneById($city);
       // var_dump($city->getRegion());
        $region = ($city) ?  $data->getRegion():null;//$c->getRegion() : null;//$city->getRegion();
    
        $this->addRegionForm($form, $region);
    }
 
    public function preSubmit(FormEvent $event)
    {
        $form = $event->getForm();
 
        $this->addRegionForm($form);
    }
}