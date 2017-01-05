<?php
// src/Ucict/Bundle/StudentBundle/Form/RegisterType.php
namespace Ucict\Bundle\StudentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, array(
				'attr'=>array(
					'class'=>'all'
				),
				'label'    => 'Име',
				'required' => true,
				
			))
            ->add('middlename', TextType::class, array(
				'attr'=>array(
					'class'=>'all'
				),
				'label'    => 'Презиме',
				'required' => true,
				//'error_bubbling' => true,
			))
			->add('lastname', TextType::class, array(
				'attr'=>array(
					'class'=>'all'
				),
				'label'    => 'Фамилия',
				'required' => true,
				//'error_bubbling' => true,
			))
			->add('othername', TextType::class, array(
				'attr'=>array(
					'class'=>'all'
				),
				'label'    => 'Друго име',
				'required' => false,
			))
			->add('personalnumber', TextType::class, array(
				'attr'=>array(
					'class'=>'all'
				),
				'label'    => 'ЕГН',
				'required' => true,
				//'error_bubbling' => true,
			))
			->add('birthdate', BirthdayType::class, array(
				
				
				'label'          =>'Дата на раждане',
				'format' => 'dd . MM . yyyy',
				'required'       => true,
				//'error_bubbling' => true,

			))
			->add('graduateyear', TextType::class, array(
				
				'attr'           => array(
				
					'class'      =>'all'
				),
				'label'          => 'Година на завършване',
				'required'       => true,
				//'error_bubbling' => true,
			))
           
			
			 ->add('save', SubmitType::class, array(
				'label'         =>  'Запази',
			));
        
    }
}
