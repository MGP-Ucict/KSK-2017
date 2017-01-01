<?php 
namespace Ucict\Bundle\StudentBundle\Form\Model;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;
use Symfony\Component\Validator\Constraints as Assert;


class Reset {
/**
 * @SecurityAssert\UserPassword(
 *     message = "Погрешно сте въвели старата си парола."
 * )
 */
protected $oldpassword;
/**
 * @Assert\NotBlank(message = "Моля, въведете нова парола")
 */
protected $newpassword;

public function setOldPassword($oldpassword){
	$this->oldpassword = $oldpassword;
}

public function setNewPassword($newpassword){
	$this->newpassword = $newpassword;
}

public function getOldPassword(){
	return $this->oldpassword;
}
public function getNewPassword(){
	return $this->newpassword;
}
	
}