<?php

namespace Ucict\Bundle\StudentBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="student")
 */
class Student {

	 /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
	private $id;
	/**
     * @ORM\Column(type="integer")
     */
	private $user_id;
	/**
     * @ORM\Column(type="string", length=255)
     */
	private $first_name;
	/**
     * @ORM\Column(type="string", length=255)
     */
	private $middle_name;
	/**
     * @ORM\Column(type="string", length=255)
     */
	private $last_name;
	/**
     * @ORM\Column(type="string", length=255)
     */
	private $other_name;
	/**
     * @ORM\Column(type="string", length=10)
     */
	private $personal_number;
	/**
     * @ORM\Column(type="integer")
     */
	private $personal_number_type;
	
	

	/**
     * @ORM\OneToOne(targetEntity="Profile", inversedBy="student")
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     */
	private $profile_id;

	/**
	 * @return integer 
	 */
	public function getId() {
		return $this->id;
	}
	
	
	public function getUserId() {
		return $this->user_id;
	}

	public function setUserId($userid) {
		$this->user_id = $userid;
		return $this;
	}

	
	public function getFirstName() {
		return $this->first_name;
	}

	public function setFirstName($firstName) {
		$this->first_name = $firstName;
		return $this;
	}

	public function getMiddleName() {
		return $this->middle_name;
	}

	public function setMiddleName($middleName = null) {
		$this->middle_name = $middleName;
		return $this;
	}

	public function getLastName() {
		return $this->last_name;
	}

	public function setLastName($lastName) {
		$this->last_name = $lastName;
		return $this;
	}

	public function getOtherName() {
		return $this->other_name;
	}

	public function setOtherName($otherName) {
		$this->other_name = $otherName;
		return $this;
	}

	public function getPersonalNumber() {
		return $this->personal_number;
	}

	public function setPersonalNumber($personalNumber = null) {
		$this->personal_number = $personalNumber;
		return $this;
	}

	public function getPersonalNumberType() {
		return $this->personal_number_type;
	}

	public function setPersonalNumberType(
	//PersonalNumberType 
	$personalNumberType) {
		$this->personal_number_type = $personalNumberType;
		return $this;
	}

	public function getProfileId() {
		return $this->profile_id;
	}

	public function setProfileId($profileid) {
		$this->profile_id = $profileid;
		return $this;
	}

}
