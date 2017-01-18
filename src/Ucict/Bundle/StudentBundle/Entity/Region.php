<?php

namespace Ucict\Bundle\StudentBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Regex; 
use Doctrine\Common\Collections\ArrayCollection;
 
 use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="Nomenclature_Region")
 */
class Region{
	private $id;
	private $name;
	private $shortName;
	/**
     * @ORM\OneToMany(targetEntity="City", mappedBy="region")
     */
    private $cities;

    public function __construct()
    {
        $this->cities = new ArrayCollection();
    }
public function __toString() {
    return $this->name;
}

public function getId(){
	return $this->id;
}
public function setId($id){
	$this->id = $id;
	return $this;
}

public function getName(){
	return $this->name;
}

public function setName($name){
	$this->name = $name;
	return $this;
}
/**
     * Get region
     *
     * @return string
     */
public function getRegion(){
	return $this->region;
}

public function setRegion($name){
	$this->region = $name;
	//return $this;
}
public function getShortName(){
	return $this->shortName;
} 
public function setShortName($shortname){
	$this->shortName = $shortname;
	return $this;

}
public function getCities(){
	return $this->cities;
} 
}