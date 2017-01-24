<?php
// src/Ucict/Bundle/StudentBundle/Form/ProfileType.php
namespace Ucict\Bundle\StudentBundle\Form;
use Ucict\Bundle\StudentBundle\Entity\Profile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
// use Ucict\Bundle\StudentBundle\Form\EventListener\AddCityFieldSubscriber;
// use Ucict\Bundle\StudentBundle\Form\EventListener\AddRegionFieldSubscriber;
use Ucict\Bundle\StudentBundle\Form\AddressType;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
	
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
		$propertyPathToCity = "city";
        $builder
            ->add('graduateyear', TextType::class, array(
				'attr'=>array(
					'class'=>'all'
				),
				'label'    => 'Година на завършване',
				'required' => true,
				
				
			))
			
			
			->add('phone', TextType::class, array(
				
				
				'label'          =>'Телефон',
				
				'required'       => false,
				//'error_bubbling' => true,
				

			))
			->add('secondphone', TextType::class, array(
				
				'attr'           => array(
				
					'class'      =>'all'
				),
				'label'          => 'Друг телефон',
				'required'       => false,
				//'error_bubbling' => true,
			))
           ->add('gsm', TextType::class, array(
				
				'attr'           => array(
				
					'class'      =>'all'
				),
				'label'          => 'GSM',
				'required'       => true,
				//'error_bubbling' => true,
			))
			->add('secondgsm', TextType::class, array(
				
				'attr'           => array(
				
					'class'      =>'all'
				),
				'label'          => 'Втори GSM',
				'required'       => false,
				//'error_bubbling' => true,
			))	
			 // ->add('addresses', CollectionType::class, array(
    //         	'entry_type' => AddressType::class,
    //         	//'by_reference' => false,
				//  // array("mapped"=>false),
    //     ))
			->add('save', SubmitType::class, array(
				'label'         =>  'Запази',
			));
		
        
 
			
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Profile::class,
        ));
    }
}
