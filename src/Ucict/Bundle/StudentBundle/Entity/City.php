<?php

namespace Ucict\Bundle\StudentBundle\Entity;
use Ucict\Bundle\StudentBundle\Entity\Address;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Regex; 
use Doctrine\Common\Collections\ArrayCollection;
 
 use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="Nomenclature_CityEkatte")
 */
class City{
	private $id;
	private $regionId;
	private $name;
	/**
     * @ORM\ManyToOne(targetEntity="Region", inversedBy="cities")
     * @ORM\JoinColumn(name="region_id", referencedColumnName="id")
     */
    private $region;

    /**
     * @OneToMany(targetEntity = "Address", mappedBy = "city")
     */
    private $addresses;

    public function __construct(){

    	$this->addresses = new ArrayCollection();
    }

//Here generate the get and the set customized
 /**
 * @return RegionEntity
 */
public function getRegion()
{
    return $this->region;

}


public function setRegion($region)
{
    //this is the owning side
    //all changes will be detected
    //in this side by doctrine
    //$category->addProduct($this);
    $this->region= $region;

    //The line below is important to set the categoryid 
    //field in the product table
    //$this->setCategoryid($category->getId());
    return $this;
}
public function __toString() {
    return (string) $this->name;
}
public function __get($id) {
    return $this->id;
}
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
		return $this;
	}

	public function getRegionId(){
		return $this->regionId;
	}

	public function setRegionId($regionId){
		$this->regionId = $regionId;
		return $this;
	}

	public function getName(){
	return $this->name;
	}

	public function setName($name){
		$this->name = $name;
		return $this;
	}
	public function getCity(){
	return $this->id;
	}

	public function setCity($city){
		$this->id = $city;
		return $this;
	}
	public function setAddresses( $address){
		$this->addresses = $address;
		return $this;
	}
	public function getAddresses(){
		return $this->addresses;
	}
}	