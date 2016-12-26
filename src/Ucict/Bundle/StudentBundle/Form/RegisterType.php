<?php
// src/Ucict/Bundle/StudentBundle/Form/RegisterType.php
namespace Ucict\Bundle\StudentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
class RegisterType extends AbstractType
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
			))
			->add('lastname', TextType::class, array(
				'attr'=>array(
					'class'=>'all'
				),
				'label'    => 'Фамилия',
				'required' => true,
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
			))
			->add('email', RepeatedType::class, array(
				'type'           => EmailType::class,
				'first_options'  => array('label' => 'E-mail адрес'),
				'second_options' => array('label' =>'Повторете e-mail адреса'),
				'attr'           =>array(
				
					'class'      =>'all'
				),
				'required'       => true,
			))
			->add('password', RepeatedType::class, array(
				'type'           => PasswordType::class,
				'first_options'  => array('label' => 'Парола'),
				'second_options' => array('label' =>'Повторете паролата'),
				'attr'           => array(
				
					'class'      =>'all'
				),
				'required'       => true,
			))
            ->add('save', SubmitType::class, array(
				'label'         =>  'Регистрация',
			))
        ;
    }
}
