<?php

namespace Ucict\Bundle\StudentBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Ucict\Bundle\StudentBundle\Form\RegisterType;
use Ucict\Bundle\StudentBundle\Form\ProfileType;
use Ucict\Bundle\StudentBundle\Entity\User;
use Ucict\Bundle\StudentBundle\Entity\Student;
use Ucict\Bundle\StudentBundle\Entity\Profile;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Doctrine\ORM\EntityRepository;
use Ucict\Bundle\StudentBundle\Form\Model\Register;
use Ucict\Bundle\StudentBundle\Form\Model\Reset;
use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
//$session->start();


class UserController extends Controller{

/**
 * @Route("/register", name = "register")
 */
public function registerAction(Request $request){
 $session = new Session();
 //$session->start();
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
	
	$user_object    = $this->getDoctrine()->getRepository('StudentBundle:User')->findOneByEmail($email);
	if( $user_object ){
		$session->getFlashBag()->add('notice2', 'Този e-mail вече е регистриран в системата');
		return $this->render('User/register.html.twig', array('form'=>$form->createView()));
	}
	
	$user            = new User();
	//encode the password
	$factory         = $this->get('security.encoder_factory');
	$encoder         = $factory->getEncoder($user);
	$encodedPassword = $encoder->encodePassword($password, $user->getSalt());
	
	$student         = new Student();
	
	$user->setEmail($email);
	$user->setPassword($encodedPassword);

	$em = $this->getDoctrine()->getManager();
	$em->persist($user);
	$em->flush();
	
	$userid = $user->getId();
	
	$student->setFirstName($firstname);
	$student->setMiddleName($middlename);
	$student->setLastName($lastname);
	$student->setOtherName($othername);
	$student->setPersonalNumber($personalnumber);
	$student->setPersonalNumberType(0);
	$student->setProfileId(0);
	$student->setUserId($userid);
	$em->persist($student);
	$em->flush();
	
	$name = $firstname . " ". $lastname;
	$message = \Swift_Message::newInstance()
        ->setSubject('КСК 2017  Регистрация на кандидат-студент в СУ "Св. Климент Охридски" ')
        ->setFrom('mpenelova@ucc.uni-sofia.bg')
        ->setTo($email)
        ->setBody(
            $this->renderView(
                'User/index.html.twig',
                array('name' => $name, 'userid'=>$userid)
            ),
            'text/html'
        );
    $this->get('mailer')->send($message);
   
	$session->getFlashBag()->add('notice', 'Вие се регистрирахте успешно в системата');
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
	
	$em = $this->getDoctrine()->getManager();
	$user  = $this->getUser();

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
	
	
	}
	return $this->render('User/reset.html.twig', array(
	'form'=>$form->createView(),
	));		
	 }

/**
 * @Route("/confirm_registration", name = "confirm_registration")
 */
public function confirm_registrationAction(Request $request){
	
$routeName = $request->getUri();
$route_arr = explode("=", $routeName);
$userid = $route_arr[1];


$user   = $this->getDoctrine()->getRepository('StudentBundle:User')->findOneById($userid);
$user->setActivated(1);
$em = $this->getDoctrine()->getManager();
$em->persist($user);
$em->flush();

return $this->render('User/confirm_registration.html.twig', array( ));
 

}

/**
 * @Route("/profile", name = "profile")
 */
 public function profileAction(Request $request){

 $profile  = new Profile();

 $form 	   = $this->createForm( ProfileType::class, $profile );
$form->handleRequest( $request );
 if( $form->isSubmitted()  && $form->isValid()){
	$em             = $this->getDoctrine()->getManager();
	$firstname      = $form->get('firstname')->getData();
	$middlename     = $form->get('middlename')->getData();
	$lastname       = $form->get('lastname')->getData();
	$othername      = $form->get('othername')->getData();
	$personalnumber = $form->get('personalnumber')->getData();
	$birthdate      = $form->get('birthdate')->getData();
	$graduateyear   = $form->get('graduateyear')->getData();

	//$user_object    = $this->getDoctrine()->getRepository('StudentBundle:User')->findOnByEmail($mail);
	//if( $user_object ){
		//throw Exception
//	}
	
	//$profile         = new Profile();
	
	$student         = new Student();
	
	
	
	
	$student->setFirstName($firstname);
	$student->setMiddleName($middlename);
	$student->setLastName($lastname);
	$student->setOtherName($othername);
	$student->setPersonalNumber($personalnumber);
	$student->setPersonalNumberType(0);
	$student->setProfileId(0);
	//$student->setUserId($userid);
	$em->persist($student);
	$em->flush();
	
	
	$this->get('session')->getFlashBag('notice', 'Вие се регистрирахте успешно в системата');
 }
//  else
// { die('not valid'); }
 return $this->render('User/profile.html.twig', array('form'=>$form->createView()));
 
 }
//  public function indexAction($name = "")
// {
//     $message = \Swift_Message::newInstance()
//         ->setSubject('Hello Email')
//         ->setFrom('mpenelova@ucc.uni-sofia.bg')
//         ->setTo('mpenelova@ucc.uni-sofia.bg')
//         ->setBody(
//             $this->renderView(
//                 // app/Resources/views/Emails/registration.html.twig
//                 'User/index.html.twig',
//                 array('name' => $name)
//             ),
//             'text/html'
//         )
//         /*
//          * If you also want to include a plaintext version of the message
//         ->addPart(
//             $this->renderView(
//                 'Emails/registration.txt.twig',
//                 array('name' => $name)
//             ),
//             'text/plain'
//         )
//         */
//     ;
//     $this->get('mailer')->send($message);

//     return $this->render('User/index.html.twig');
// }
}

