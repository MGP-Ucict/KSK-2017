<?php
// src/Ucict/Bundle/StudentBundle/Form/ProfileType.php
namespace Ucict\Bundle\StudentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

// use Ucict\Bundle\StudentBundle\Form\EventListener\AddCityFieldSubscriber;
// use Ucict\Bundle\StudentBundle\Form\EventListener\AddRegionFieldSubscriber;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileModelType extends AbstractType
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
			
			// ->addEventSubscriber(new AddRegionFieldSubscriber($propertyPathToCity))
			// ->addEventSubscriber(new AddCityFieldSubscriber($propertyPathToCity))
			// ->add('zip', TextType::class, array(
			// 	'attr'=>array(
			// 		'class'=>'all'
			// 	),
			// 	'label'    => 'Пощенски код',
			// 	'required' => false,
				
			// ))
			// ->add('address', TextType::class, array(
			// 	'attr'=>array(
			// 		'class'=>'all'
			// 	),
			// 	'label'    => 'Адрес',
			// 	'required' => true,
				
			// 	//'error_bubbling' => true,
			// ))
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
					
			->add('save', SubmitType::class, array(
				'label'         =>  'Запази',
			));
		
        
 
			
    }

}
