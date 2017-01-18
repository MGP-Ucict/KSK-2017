<?php

namespace Ucict\Bundle\StudentBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
 use Symfony\Component\Validator\Constraints\Regex; 
use Ucict\Bundle\StudentBundle\Entity\Address;
 use Doctrine\Common\Collections\ArrayCollection;
 use Doctrine\ORM\Mapping as ORM;
 use Doctrine\ORO\Mapping as ORO;
/**
 * @ORM\Entity
 * @ORM\Table(name="student_profile")
 */
class Profile {

    /**
     * @var integer
     */
    private $id;
   
    
    /**
     * @Assert\NotBlank(message = "Моля, въведете година на завършване")
     * @Assert\Regex(pattern     = "/[0-9]/", message = "Моля, въведете годината с цифри"
     * )
     * @Assert\LessThan(2017, message = "Годината на завършване е по-малка от 2017")
     * @ORM\Column(name = "graduate_year", type="integer")
     */
    private $graduateYear;

     private $genderId;
     private $birthDate;
     /*
     * 
     * @OneToOne(targetEntity="Address", inversedBy="profile")
     * @JoinColumn(name="contact_address_id", referencedColumnName="id")
     */
    //private $addresses;
     private $contactAddressId;
	/**
     * @ORM\Column(name = "phone", type="string", length=32)
     */
     private $phone;
     /**
      * @ORM\Column(name = "second_phone", type="string", length=32)
      */
     private $secondPhone;
   //  //private $second_email;
     /**
      * @ORM\Column(name = "contactAddressId", type="integer")
      */
   // // private $contactAddressId;

   //   // function __construct(Student $student) {
   //   //    $this->student = $student;
   //   // }
    
     private $userId;
     /**
      * @Assert\NotBlank(message = "Моля, въведете gsm")
      * @ORM\Column(name = "gsm", type="string", length=32)
      */
     private $gsm;
    /**
     * @ORM\Column(name = "second_gsm", type="string", length=32)
     */
     private $secondGsm;


    
   
    public function __construct()
    {
       // $this->addresses = new ArrayCollection();
    }

    /**
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }
     public function addAddress(Address $address)
    {
        $this->addresses = $address;
    }

    public function removeAddress(Address $address)
    {
        // ...
    }
   
    /* public function getNationality() {
      return $this->nationality;
      }

      public function setNationality(Nationality $nationality = null) {
      $this->nationality = $nationality;
      return $this;
      } */

    public function getGenderId() {
         return $this->genderId;
    }

     public function setGenderId($gender) {
         $this->genderId = $gender;
         return $this;
     }

     public function getBirthDate() {
         return $this->birthDate;
    }

     public function setBirthDate($birthdate) {
         $this->birthDate = $birthdate;
         return $this;
     }
     public function getPhone() {
         return $this->phone;
    }

     public function setPhone($phone = null) {
         $this->phone = $phone;
         return $this;
     }

     public function getSecondPhone() {
         return $this->secondPhone;
     }

     public function setSecondPhone($secondPhone = null) {
         $this->secondPhone = $secondPhone;
         return $this;
    }

     public function getGsm() {
         return $this->gsm;
     }

     public function setGsm($gsm = null) {
         $this->gsm = $gsm;
         return $this;
     }

     public function getSecondGsm() {
         return $this->secondGsm;
     }

     public function setSecondGsm($secondGsm = null) {
         $this->secondGsm = $secondGsm;
         return $this;
     }

     public function getAddress() {
         return $this->contactAddressId;
     }

     public function setAddress($address) {
         $this->contactAddressId = $address;
        return $this;
     }

    // public function getAddresses()
    // {
    //     return $this->addresses;
    // }
    
    // public function setAddresses(Address $address){
    //     $this->addresses = $address;
    // }

    // /**
    //  * @return Student
    //  */
    // public function getStudent() {
    //     return $this->student;
     //}

    public function getGraduateYear() {
        return $this->graduateYear;
    }

    public function setGraduateYear($graduateYear) {
        $this->graduateYear = $graduateYear;
        return $this;
    }

}
