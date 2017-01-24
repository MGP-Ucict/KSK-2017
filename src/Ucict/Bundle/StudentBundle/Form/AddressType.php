<?php
// src/Ucict/Bundle/StudentBundle/Form/ProfileType.php
namespace Ucict\Bundle\StudentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Ucict\Bundle\StudentBundle\Entity\Address;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

 use Ucict\Bundle\StudentBundle\Form\EventListener\AddCityFieldSubscriber;
 use Ucict\Bundle\StudentBundle\Form\EventListener\AddRegionFieldSubscriber;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
	private $city;
    private $region;

	
    public function buildForm(FormBuilderInterface $builder, array $options)
    { 
    	

    	$this->city = $options['city'];
    	$this->region = $options['region'];

		$propertyPathToCity = "city";
        $builder
        	->addEventSubscriber(new AddRegionFieldSubscriber($propertyPathToCity, $this->region ))
			->addEventSubscriber(new AddCityFieldSubscriber($propertyPathToCity, $this->city))
            
			
			->add('zip', TextType::class, array(
				'attr'=>array(
					'class'=>'all'
				),
				'label'    => 'Пощенски код',
				'required' => false,
				
			))
			->add('streetAddress', TextType::class, array(
				'attr'=>array(
					'class'=>'all'
				),
				'label'    => 'Адрес',
				'required' => true,
				
				//'error_bubbling' => true,
			));
			
 
			
    }
 

   public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults([
            'data_class' => Address::class,
            'city' => null,
            'region' =>null,
    ]);

   // $resolver->setRequired(''); // Requires that currentOrg be set by the caller.
   // $resolver->setAllowedTypes('currentOrg', 'integer'); // Validates the type(s) of option(s) passed.
}
}
