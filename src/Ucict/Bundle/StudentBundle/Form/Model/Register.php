<?php
namespace Ucict\Bundle\StudentBundle\Form\Model;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints as CaptchaAssert;
use Symfony\Component\Validator\Constraints as Assert;
 use Symfony\Component\Validator\Constraints\Regex; 
 use Ucict\Bundle\StudentBundle\Validator\Constraints as AcmeAssert;
class Register{
/**
 * @Assert\NotBlank(message = "Моля, въведете e-mail")
 * @Assert\Email(message = "Моля, въведете валиден e-mail")
 */
protected $email;
/**
 * @Assert\NotBlank(message = "Моля, въведете парола")
 * @Assert\Length(
 *      min = 6, max = 20,
 *      minMessage = "Паролата се състои от  най-малко от 6 символа",
 *      maxMessage = "Паролата се състои от  най-много от 20  символа"
 * )
 * @Assert\Regex(pattern     = "/[A-Za-z0-9_]/", message = "Моля, въведете паролата с латински букви, цифри или _"
 * )
 */
protected $password;
/**
 * @Assert\NotBlank(message = "Моля, въведете име")
 * @Assert\Regex(pattern     = "/[А-Яа-я]+$/i", message = "Моля, въведете името на кирилица")
 */
protected $first_name;
/**
 * @Assert\NotBlank(message = "Моля, въведете презиме")
 * @Assert\Regex(pattern     = "/[А-Яа-я]+$/i", message = "Моля, въведете презимето на кирилица")
 */
protected $middle_name;
/**
 * @Assert\NotBlank(message = "Моля, въведете фамилия")
 * @Assert\Regex(pattern     = "/[А-Яа-я]+$/i", message = "Моля, въведете фамилията на кирилица")
 */
protected $last_name;
/**
 * @Assert\Regex(pattern     = "/[А-Яа-я]+$i", message = "Моля, въведете другото име на кирилица")
 */
protected $other_name;
/**
 * @Assert\NotBlank(message = "Моля, въведете ЕГН")
 * @Assert\Regex(pattern="/\d/",
 *     match=true, message = "Моля, въведете ЕГН от цифри")
 * @Assert\Length(
 *      min = 10, max = 10,
 *      exactMessage = "ЕГН се състои от  10  цифри")
 * @AcmeAssert\egn
 */
protected $personal_number;

/**
 * @CaptchaAssert\ValidCaptcha(
 *      message = "Моля, въведете кода правилно."
 * )
 */
  protected $captchaCode;

  public function getCaptchaCode()
  {
    return $this->captchaCode;
  }

  public function setCaptchaCode($captchaCode)
  {
    $this->captchaCode = $captchaCode;
  }
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

$this->first_name = $firstname;

}

public function getFirstName(){
return $this->first_name;
}

public function setMiddleName($middlename){

$this->middle_name = $middlename;

}

public function getMiddleName(){
return $this->middle_name;
}

public function setLastName($lastname){

$this->last_name = $lastname;

}

public function getLastName(){
return $this->last_name;
}

public function setOtherName($othername){

$this->other_name = $othername;

}

public function getOtherName(){
return $this->other_name;
}

public function setPersonalNumber($personalnumber){

$this->personal_number = $personalnumber;

}

public function getPersonalNumber(){
return $this->personal_number;
}
}