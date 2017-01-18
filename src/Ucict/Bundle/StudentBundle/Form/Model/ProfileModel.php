<?php

namespace Ucict\Bundle\StudentBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\Regex; 

 
 use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="student_profile")
 */
class ProfileModel {

    /**
     * @var integer
     */
    //private $id;
   /**
     * @ORM\Column(name = "region", type="integer")
     */
    private $region;
    /**
     * @ORM\Column(name = "city", type="integer")
     */
     
    private $city;
    //private $nationality;
    /**
     * @ORM\Column(name = "zip", type="string", length = 20)
     */
    private $zip;
    /**
     * @Assert\NotBlank(message = "Моля, въведете  адрес")
     * @Assert\Regex(pattern     = "/[А-Яа-я]+$/i", message = "Моля, въведете адреса на кирилица")
     * @ORM\Column(name = "address", type="string", length = 255)
     */
    private $address;
    /**
     * @ORM\Column(name = "phone", type="string", length=32)
     */
    private $phone;
    /**
     * @ORM\Column(name = "secondphone", type="string", length=32)
     */
    private $secondphone;
    //private $second_email;
    /**
     * @ORM\Column(name = "contactAddressId", type="integer")
     */
   // private $contactAddressId;

     // function __construct(Student $student) {
     //    $this->student = $student;
     // }
    
    //private $userId;
    /**
     ** @Assert\NotBlank(message = "Моля, въведете gsm")
     * @ORM\Column(name = "gsm", type="string", length=32)
     */
    private $gsm;
    /**
     * @ORM\Column(name = "secondgsm", type="string", length=32)
     */
    private $secondgsm;
    

    /**
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }
    
    
    
    

    

    public function getRegion() {
        return $this->region;
    }

    public function setRegion($regionid) {
        $this->region = $regionid;
        return $this;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($cityid) {
        $this->city = $cityid;
        return $this;
    }

     // public function getNationality() {
     //  return $this->nationality;
     //  }

     //  public function setNationality(Nationality $nationality = null) {
     //  $this->nationality = $nationality;
     //  return $this;
     //  } 

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone = null) {
        $this->phone = $phone;
        return $this;
    }

    public function getSecondphone() {
        return $this->secondphone;
    }

    public function setSecondphone($secondPhone = null) {
        $this->secondphone = $secondPhone;
        return $this;
    }

    public function getGsm() {
        return $this->gsm;
    }

    public function setGsm($gsm = null) {
        $this->gsm = $gsm;
        return $this;
    }

    public function getSecondgsm() {
        return $this->secondgsm;
    }

    public function setSecondgsm($secondGsm = null) {
        $this->secondgsm = $secondGsm;
        return $this;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    
    public function getZip() {
        return $this->zip;
    }

    public function setZip($zip) {
        $this->zip = $zip;
        return $this;
    }

    /**
     * @return Student
     */
    public function getStudent() {
        return $this->student;
    }

    
    /**
     * @Assert\NotBlank(message = "Моля, въведете година на завършване")
     * @Assert\Regex(pattern     = "/[0-9]/", message = "Моля, въведете годината с цифри"
     * )
     * @Assert\LessThan(2017, message = "Годината на завършване е по-малка от 2017")
     * @ORM\Column(name = "graduateyear", type="integer")
     */
    private $graduateyear;

    
    public function getGraduateyear() {
        return $this->graduateyear;
    }

    public function setGraduateyear($graduateYear) {
        $this->graduateyear = $graduateYear;
        return $this;
    }

}
