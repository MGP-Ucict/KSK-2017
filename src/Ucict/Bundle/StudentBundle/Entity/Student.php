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
     * @ORM\Column(name = "user_id", type="integer")
     */
	private $userId;
	/**
     * @ORM\Column(name = "first_name", type="string", length=255)
     */
	private $firstName;
	/**
     * @ORM\Column(name = "middle_name", type="string", length=255)
     */
	private $middleName;
	/**
     * @ORM\Column(name = "last_name", type="string", length=255)
     */
	private $lastName;
	/**
     * @ORM\Column(name = "other_name", type="string", length=255)
     */
	private $otherName;
	/**
     * @ORM\Column(name = "personal_number", type="string", length=10)
     */
	private $personalNumber;
	/**
     * @ORM\Column(name = "personal_number_type", type="integer")
     */
	private $personalNumberType;
	

	/**
     * 
     * @OneToOne(targetEntity="Profile")
     * @JoinColumn(name="profile_id", referencedColumnName="id")
     */
	private $profileId;

	/**
	 * @return integer 
	 */
	public function getId() {
		return $this->id;
	}
	
	
	public function getUserId() {
		return $this->userId;
	}

	public function setUserId($userid) {
		$this->userId = $userid;
		return $this;
	}

	
	public function getFirstName() {
		return $this->firstName;
	}

	public function setFirstName($firstName) {
		$this->firstName = $firstName;
		return $this;
	}

	public function getMiddleName() {
		return $this->middleName;
	}

	public function setMiddleName($middleName = null) {
		$this->middleName = $middleName;
		return $this;
	}

	public function getLastName() {
		return $this->lastName;
	}

	public function setLastName($lastName) {
		$this->lastName = $lastName;
		return $this;
	}

	public function getOtherName() {
		return $this->otherName;
	}

	public function setOtherName($otherName) {
		$this->otherName = $otherName;
		return $this;
	}

	public function getPersonalNumber() {
		return $this->personalNumber;
	}

	public function setPersonalNumber($personalNumber = null) {
		$this->personalNumber = $personalNumber;
		return $this;
	}

	public function getPersonalNumberType() {
		return $this->personalNumberType;
	}

	public function setPersonalNumberType(
	//PersonalNumberType 
	$personalNumberType) {
		$this->personalNumberType = $personalNumberType;
		return $this;
	}

	public function getProfileId() {
		return $this->profileId;
	}

	public function setProfileId($profileid) {
		$this->profileId = $profileid;
		return $this;
	}

}
