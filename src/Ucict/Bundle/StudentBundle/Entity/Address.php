<?php

namespace Ucict\Bundle\StudentBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
//use Ucict\Bundle\NomenclatureBundle\Entity\City;
/**
 * @ORM\Entity
 * @ORM\Table(name="Address")
 */
class Address {

	/**
	 * @var integer
	 */
	private $id;
	private $cityId;
	private $zip;
	private $streetAddress;
	private $region;
	private $address;

	 /*
     * 
     * @OneToOne(targetEntity="Address", mappedBy="addresses")
     */
    private $profile;
	/**
	 * @return integer 
	 */
	public function getId() {
		return $this->id;
	}

	public function getZip() {
		return $this->zip;
	}

	public function setZip($postCode) {
		$this->zip = $postCode;
		return $this;
	}
	public function getAddress() {
		return $this->id;
	}

	public function setAddress( $address) {
		$this->id = $address;
		return $this;
	}
	public function getRegion() {
		return $this->region;
	}

	public function setRegion($region) {
		$this->region = $region;
		return $this;
	}
	public function getStreetAddress() {
		return $this->streetAddress;
	}

	public function setStreetAddress($streetAddress) {
		$this->streetAddress = $streetAddress;
		return $this;
	}

	// *
	//  * @return \Ucict\Bundle\NomenclatureBundle\Entity\City
	 
	public function getCityId() {
		return $this->cityId;
	}

	public function setCityId( $city = null) {
		$this->cityId = $city;
		return $this;
	}
	public function getCity() {
		return $this->cityId;
	}

	public function setCity( $city = null) {
		$this->cityId = $city;
		return $this;
	}

}
