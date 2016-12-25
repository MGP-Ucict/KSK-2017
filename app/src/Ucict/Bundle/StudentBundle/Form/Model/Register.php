<?php
namespace Ucict\Bundle\StudentBundle\Form\Model;

class Register{
protected $email;
protected $password;
protected $firstname;
protected $middlename;
protected $lastname;
protected $othername;
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