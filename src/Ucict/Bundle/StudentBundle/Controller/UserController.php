<?php

namespace Ucict\Bundle\StudentBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Ucict\Bundle\StudentBundle\Form\RegisterType;
use Ucict\Bundle\StudentBundle\Entity\User;
use Ucict\Bundle\StudentBundle\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityRepository;
use Ucict\Bundle\StudentBundle\Form\Model\Register;
use Ucict\Bundle\StudentBundle\Form\Model\Reset;


class UserController extends Controller{

/**
 * @Route("/register", name = "register")
 */
public function registerAction(Request $request){

 $register = new Register();
 $form 	   = $this->createForm( RegisterType::class, $register );
 $form->handleRequest( $request );
 if( $form->isSubmitted()  && $form->isValid()){
	$em             = $this->getDoctrine()->getManager();
	$firstname      = $form->get('firstname')->getData();
	$middlename     = $form->get('middlename')->getData();
	$lastname       = $form->get('lastname')->getData();
	$othername      = $form->get('othername')->getData();
	$personalnumber = $form->get('personalnumber')->getData();
	$email          = $form->get('email')->getData();
	$password       = $form->get('password')->getData();
	
	//$user_object    = $this->getDoctrine()->getRepository('StudentBundle:User')->findOnByEmail($mail);
	//if( $user_object ){
		//throw Exception
//	}
	
	$user            = new User();
	//encode the password
	$factory         = $this->get('security.encoder_factory');
	$encoder         = $factory->getEncoder($user);
	$encodedPassword = $encoder->encodePassword($password, $user->getSalt());
	
	$student         = new Student();
	
	$user->setEmail($email);
	$user->setPassword($encodedPassword);
	
	$em->persist($user);
	$em->flush();
	
	$userid = $user->getId();
	
	$student->setFirstName($firstname);
	$student->setMiddleName($middlename);
	$student->setLastName($lastname);
	$student->setOtherName($othername);
	$student->setPersonalNumber($personalnumber);
	$student->setPersonalNumberType(1);
	$student->setProfileId(0);
	$student->setUserId($userid);
	$em->persist($student);
	$em->flush();
	
	
	$this->get('session')->getFlashBag('notice', 'Вие се регистрирахте успешно в системата');
 }
 return $this->render('User/register.html.twig', array('form'=>$form->createView()));
 
}
 public function loginAction(Request $request)
{
    $authenticationUtils = $this->get('security.authentication_utils');

    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();

    return $this->render('User/login.html.twig', array(
        'last_username' => $lastUsername,
        'error'         => $error,
    ));
}

	/**
	 * @Route( "/reset", name= "reset")
	 */
	 public function resetAction( Request $request){
	 /*if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
	 	return $this->redirect($this->generateUrl('login'));
    }
*/
	 $reset = new Reset();
	 $form = $this->createFormBuilder($reset)
				->add('oldpassword', PasswordType::class, array(
				'attr'=>array(
					'class'=>'all'
				),
				'label'    => 'Стара парола',
				))
				->add('newpassword', RepeatedType::class, array(
				'type'=> PasswordType::class,
				'invalid_message' => 'Въведените пароли не са еднакви.',
				'first_options'  => array('label' =>'Нова парола'),
				'second_options' => array('label' =>'Повторете новата парола'),
				))
				->add('submit', SubmitType::class, array(
				'attr'=>array(
					'class'=>'all'
				),
				'label'    => 'Запазване',
				))
				->getForm();
	$form->handleRequest($request);
	if($form->isSubmitted() && $form->isValid()){
	$session = $request->getSession();
	
	//var_dump($username);
	$em = $this->getDoctrine()->getManager();
	$user  = $this->getUser();
//$em->getRepository('AppBundle:User')->findOneByUsername($username);
	$currentPassword = $user->getPassword();
	$oldPassword = $form->get('oldpassword')->getData();
	$newpassword =  $form->get('newpassword')->getData();
	$factory = $this->get('security.encoder_factory');
	$encoder = $factory->getEncoder($user);
	
	
	$validPassword = $encoder->isPasswordValid(
		$currentPassword,
		$oldPassword,
		$user->getSalt()
		);
	if($validPassword){
	
		$encodedPassword = $encoder->encodePassword($newpassword, $user->getSalt());

		$user->setPassword($encodedPassword);
		$em->persist($user);
		$em->flush();
		$this->get('session')->getFlashBag()->add(
        'notice1',
		'Успешно сменихте паролата си!'
        
    );
	}
	else{
	$this->get('session')->getFlashBag()->add(
        'notice2',
		'Невалидна стара парола!'
    );
	}
	
	}
	return $this->render('User/reset.html.twig', array(
	'form'=>$form->createView(),
	));		
	 }
}

