<?php

namespace Ucict\Bundle\StudentBundle\Entity;

class Student {

	/**
	 * @var integer
	 */
	private $id;
	private $userid;
	private $firstName;
	private $middleName;
	private $lastName;
	private $otherName;
	private $personalNumber;
	private $personalNumberType;
	private $profileid;

	/**
	 * @return integer 
	 */
	public function getId() {
		return $this->id;
	}
	
	
	public function getUserId() {
		return $this->userid;
	}

	public function setUserId($userid) {
		$this->userid = $userid;
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

	public function setPersonalNumberType(PersonalNumberType $personalNumberType) {
		$this->personalNumberType = $personalNumberType;
		return $this;
	}

	public function getProfileId() {
		return $this->profileid;
	}

	public function setProfileId($profileid) {
		$this->profileid = $profileid;
		return $this;
	}

}
