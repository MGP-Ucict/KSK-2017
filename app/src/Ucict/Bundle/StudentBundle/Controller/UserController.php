<?php

namespace Ucict\Bundle\StudentBundle\Controller;

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
	$firstname      = $form->get('fistname')->getData();
	$middlename     = $form->get('middlename')->getData();
	$lastname       = $form->get('lastname')->getData();
	$othername      = $form->get('othername')->getData();
	$personalnumber = $form->get('personalnumber')->getData();
	$email          = $form->get('email')->getData();
	$password       = $form->get('password')->getData();
	
	$user_object    = $this->getDoctine()->getRepository('/Ucict/Bundle/StudentBundle:User')->findOnByEmail($mail);
	if( $user_object ){
		//throw Exception
	}
	
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
	$student->setUserId($userid);
	$em->persist($student);
	$em->flush();
	
	$studentid = $student->getId();
	$user->setStudentId($studentid);
	$em->persist($user);
	$em->flush();
	
	$this->get('session')->getFlashBag('notice', 'Вие се регистрирахте успешно в системата');
 }
 return $this->render('User/register.html.twig', array('form'=>$form->createView()));
 
}
 
}

