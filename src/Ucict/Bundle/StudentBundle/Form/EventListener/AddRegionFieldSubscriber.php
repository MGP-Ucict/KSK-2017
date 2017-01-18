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
 
    public function __construct($propertyPathToCity)
    {
        $this->propertyPathToCity = $propertyPathToCity;
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
 
        $accessor = PropertyAccess::createPropertyAccessor();
       
        $city    = $accessor->getValue($data, $this->propertyPathToCity);
       // var_dump("city=".$city);
        //$city = $this->getDoctrine()->getRepository('StudentBundle:City')->findOneById($city);
        $region = new Region();
        $c = new City();
        $c->setId($city);
        $region = ($city) ?  $c->getRegion() : null;//$city->getRegion();
 
        $this->addRegionForm($form, $region);
    }
 
    public function preSubmit(FormEvent $event)
    {
        $form = $event->getForm();
 
        $this->addRegionForm($form);
    }
}