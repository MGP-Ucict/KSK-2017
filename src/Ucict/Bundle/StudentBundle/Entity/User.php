<?php

namespace Ucict\Bundle\StudentBundle\Entity;

use Serializable;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="student_user")
 */
class User implements UserInterface, Serializable {

	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	private $id;

	/**
     * @ORM\Column(type="string", length=255)
     */
	private $email;

	/**
     * @ORM\Column(type="string", length=1000)
     */
	private $password;
	private $studentid;
	/**
     * @ORM\Column(type="integer", length=1)
	 * @ORM\is_activated
     */
	private $is_activated = false;

	/**
	 * @return integer 
	 */
	public function getId() {
		return $this->id;
	}

	
	public function getStudentId() {
		return $this->studentid;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	
	public function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @param string $password
	 * @return \Ucict\Bundle\UserBundle\Entity\User
	 */
	public function setPassword($password) {
		$this->password = $password;
		return $this;
	}

	public function eraseCredentials() {
	}

	public function getSalt() {
		return null;
	}

	public function getUsername() {
		return $this->email;
	}

	public function serialize() {
		return serialize(array($this->id, $this->email));
	}

	public function unserialize($serialized) {
		list($this->id, $this->email) = unserialize($serialized);
	}

	public function getRoles() {
		return array('ROLE_STUDENT');
	}

	/**
	 * @return string
	 */
	public function getActivationCode() {
		return $this->activationCode;
	}

	/**
	 * @param string $activationCode
	 * @return \Ucict\Bundle\StudentBundle\Entity\User
	 */
	public function setActivationCode($activationCode = NULL) {
		$this->activationCode = $activationCode;
		return $this;
	}
	
	public function isActivated() {
		return $this->is_activated;
	}

	public function setActivated($activated) {
		$this->is_activated = (boolean)$activated;
		return $this;
	}

}
