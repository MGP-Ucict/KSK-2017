<?php
namespace Ucict\Bundle\StudentBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

class Register{
/**
 * @Assert\NotBlank(message = "Моля, въведете e-mail")
 * @Assert\Email(message = "Моля, въведете валиден e-mail")
 */
protected $email;
/**
 * @Assert\NotBlank(message = "Моля, въведете парола")
 */
protected $password;
/**
 * @Assert\NotBlank(message = "Моля, въведете име")
 * @Assert\Regex(pattern     = "/^[а-яА-Я]+$/i", message = "Моля, въведете името на кирилица")
 */
protected $firstname;
/**
 * @Assert\NotBlank(message = "Моля, въведете презиме")
 * @Assert\Regex(pattern     = "/^[а-яА-Я]+$/i", message = "Моля, въведете презимето на кирилица")
 */
protected $middlename;
/**
 * @Assert\NotBlank(message = "Моля, въведете фамилия")
 * @Assert\Regex(pattern     = "/^[а-яА-Я]+$/i", message = "Моля, въведете фамилията на кирилица")
 */
protected $lastname;
/**
 * @Assert\Regex(pattern     = "/^[а-яА-Я]+$/i", message = "Моля, въведете другото име на кирилица")
 */
protected $othername;
/**
 * @Assert\NotBlank(message = "Моля, въведете ЕГН")
 * @Assert\Length(
 *      min = 10, max = 10,
 *      exactMessage = "ЕГН се състои от {{ 10 }} цифри")
 */
protected $personalnumber;

public function setEmail($email){

$this->email = $email;

}

public function getEmail(){
return $this->email;
}

public function setPassword($password){

$this->password = $password;

}

public function getPassword(){
return $this->password;
}

public function setFirstName($firstname){

$this->firstname = $firstname;

}

public function getFirstName(){
return $this->firstname;
}

public function setMiddleName($middlename){

$this->middlename = $middlename;

}

public function getMiddleName(){
return $this->middlename;
}

public function setLastName($lastname){

$this->lastname = $lastname;

}

public function getLastName(){
return $this->lastname;
}

public function setOtherName($othername){

$this->othername = $othername;

}

public function getOtherName(){
return $this->othername;
}

public function setPersonalNumber($personalnumber){

$this->personalnumber = $personalnumber;

}

public function getPersonalNumber(){
return $this->personalnumber;
}
}