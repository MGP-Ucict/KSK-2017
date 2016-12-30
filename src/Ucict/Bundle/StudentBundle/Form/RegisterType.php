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
				'required' => false,
			))
            ->add('middlename', TextType::class, array(
				'attr'=>array(
					'class'=>'all'
				),
				'label'    => 'Презиме',
				'required' => false,
			))
			->add('lastname', TextType::class, array(
				'attr'=>array(
					'class'=>'all'
				),
				'label'    => 'Фамилия',
				'required' => false,
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
				'required' => false,
			))
			->add('email', RepeatedType::class, array(
				'type'           => EmailType::class,
				'invalid_message' => 'Въведените e-mail адреси не са еднакви.',
				 'required'        => false,
				'error_bubbling'  => false,
				'first_options'  => array('label' => 'E-mail адрес', 'error_bubbling' => true),
				'second_options' => array('label' =>'Повторете e-mail адреса', 'error_bubbling' => false),
				'attr'           =>array(
				
					'class'      =>'all'
				),
				'required'       => false,
			))
			->add('password', RepeatedType::class, array(
				'type'           => PasswordType::class,
				'invalid_message' => 'Въведените пароли не са еднакви.',
				'required'        => false,
				'error_bubbling'  => false,
				'first_options'  => array('label' => 'Парола', 'error_bubbling' => true),
				'second_options' => array('label' =>'Повторете паролата', 'error_bubbling' => false),
				'attr'           => array(
				
					'class'      =>'all'
				),
				'required'       => false,
			))
           
			->add('captchaCode', 'Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType', array(
  'captchaConfig' => 'ExampleCaptcha'
			))
			 ->add('save', SubmitType::class, array(
				'label'         =>  'Регистрация',
			));
        
    }
}
