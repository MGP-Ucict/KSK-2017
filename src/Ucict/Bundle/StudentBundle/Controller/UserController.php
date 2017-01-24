<?php

namespace Ucict\Bundle\StudentBundle\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use DateTime;

use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Ucict\Bundle\StudentBundle\Form\RegisterType;
use Ucict\Bundle\StudentBundle\Form\ProfileType;
use Ucict\Bundle\StudentBundle\Form\AddressType;
use Ucict\Bundle\StudentBundle\Entity\User;
use Ucict\Bundle\StudentBundle\Entity\Address;
use Ucict\Bundle\StudentBundle\Entity\Student;
use Ucict\Bundle\StudentBundle\Entity\City;
use Ucict\Bundle\StudentBundle\Entity\Region;
use Ucict\Bundle\StudentBundle\Entity\Profile;
use Ucict\Bundle\StudentBundle\Form\Model\ProfileModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\PropertyAccess\PropertyPath;
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
	
	$profile = new Profile();

	$egnYear = intval(substr($personalnumber, 0, 2));
			$egnMonth = intval(substr($personalnumber, 2, 2));
			$egnDay = intval(substr($personalnumber, 4, 2));
			$egnGender = intval(substr($personalnumber, 8, 1)) % 2;

			if ($egnMonth >= 1 && $egnMonth <= 12) {
				$egnYear += 1900;
			} else if ($egnMonth >= 41 && $egnMonth <= 52) {
				$egnYear += 2000;
				$egnMonth -= 40;
			}

			
				$birthdate = DateTime::createFromFormat('Y-m-d', 
										sprintf('%04d-%02d-%02d', $egnYear, $egnMonth, $egnDay));
			

			$gender = ($egnGender == 0) ? 1 : 2;


			$profile->setGenderId($gender);
			$profile->setBirthDate($birthdate);
			$em->persist($profile);
	$em->flush();
	$profile_id = $profile->getId();
	$student->setFirstName($firstname);
	$student->setMiddleName($middlename);
	$student->setLastName($lastname);
	$student->setOtherName($othername);
	$student->setPersonalNumber($personalnumber);
	$student->setPersonalNumberType(0);
	$student->setProfileId($profile_id);
	$student->setUserId($userid);
	$em->persist($student);
	$em->flush();
	
	$name = $firstname . " ". $lastname;
	$message = \Swift_Message::newInstance()
        ->setSubject('КСК 2017  Регистрация на кандидат-студент в СУ "Св. Климент Охридски" ')
        ->setFrom('ksksupport@uni-sofia.bg')
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
	 if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
	 	return $this->redirect($this->generateUrl('login'));
    }

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

  
$session = new Session();
$address_id = 0;
$user_id = $this->getUser()->getId();
$student = $this->getDoctrine()->getRepository('StudentBundle:Student')->findOneByUserId($user_id);
$profile_id = $student->getProfileId();

$em             = $this->getDoctrine()->getManager();

$profile = $this->getDoctrine()->getRepository('StudentBundle:Profile')->findOneById($profile_id);
$address_id = $profile->getContactAddressId();

$region = new Region();
$city = new City();
$city_id = null;
$region_id= null;

$address = new Address();
if(!$address_id){
	$address = new Address();
	
	$em->persist($address);
	$em->flush();
	$address_id = $address->getId();
	$profile->setContactAddressId($address_id);
	
	$em->persist($profile);
	
	$em->flush();
}



if($address_id){
	
	$address = $this->getDoctrine()->getRepository('StudentBundle:Address')->findOneById($address_id);
	$city_id =($address) ?($address->getCityId()):null;
	if($city_id){
	$city = $this->getDoctrine()->getRepository('StudentBundle:City')->findOneById($city_id);
	if($city){
	
	$region = $city->getRegion();
} 
}
}

$birthdate = $profile->getBirthDate()->format('d.m.Y');
$gender = ($profile->getGenderId() % 2 == 0) ? "жена" : "мъж";

$session->set('userid', $user_id);
$name = $student->getFirstName()." ".$student->getLastName();
$session->set('studname', $name);
$em             = $this->getDoctrine()->getManager();
$em->persist($profile);
 
$em->flush();
$form 	   = $this->createForm(ProfileType::class, $profile );
  
$arr = array();

  
if($city->getName() ){
  $arr = array(
    'action'     => $this->generateUrl('profile'),
    'city' =>  $city,
    'region' =>$region,
    );
}
else{
	$arr = array(
    'action'     => $this->generateUrl('profile'),
    );
}
 
$f = $this->createForm(AddressType::class, $address, $arr);
   
$form->handleRequest( $request );
$f->handleRequest( $request );

if( $f->isSubmitted() && $f->isValid()){
	$em             = $this->getDoctrine()->getManager();

	$street_address   = $f->get('streetAddress')->getData();
	$post_code   = $f->get('zip')->getData();
	
    $city   = $f->get('city')->getData();
    
    if($city){
    	$city_id = $city->getId();
}
	
$address->setStreetAddress($street_address);
$address->setZip($post_code);
$address->setCityId($city_id);
   
$em->flush();
$address_id = $address->getId();
$graduateyear   = $form->get('graduateyear')->getData();

	
$phone          = $form->get('phone')->getData();
$secondphone    = $form->get('secondphone')->getData();
$gsm            = $form->get('gsm')->getData();
$secondgsm      = $form->get('secondgsm')->getData();

$profile->setPhone($phone);
$profile->setContactAddressId($address_id);
$profile->setSecondPhone($secondphone);
$profile->setGsm($gsm);
$profile->setSecondGsm($secondgsm);
$profile->setGraduateYear($graduateyear);

$em->persist($profile);
$em->flush();
}
	
 

return $this->render('User/profile.html.twig', array('form' => $form->createView(),
 													  'student' => $student,
 													  'birthdate' => $birthdate,
 													  'gender' =>$gender,
 													  'f' =>$f->createView(),
 													  

));
 
}

 
 /**
 * @Route("/regions", name="regions")
 */
public function regionsAction(Request $request)
{
 	   
 	
    $em = $this->getDoctrine()->getManager();
    $provinces = $em->getRepository('StudentBundle:Region')->findAll();
 	
    return new JsonResponse($provinces);
}
 
/**
 * @Route("/cities", name="cities")
 */
public function citiesAction(Request $request)
{ 

	

    $region_id = $request->query->get('region');
 
    $em = $this->getDoctrine()->getManager();
    $cities = $em->getRepository('StudentBundle:City')->findByRegionId($region_id);
 	
    return new JsonResponse($cities);
}
}

