<?php

namespace Ucict\Bundle\StudentBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;
 use Symfony\Component\Validator\Constraints\Regex; 

 use Ucict\Bundle\StudentBundle\Validator\Constraints as AcmeAssert;
 use Doctrine\ORM\Mapping as ORM;
use DateTime;
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
     * @ORM\OneToOne(targetEntity="Student", mappedBy="student_profile")
     */
    private $studentid;
    /**
     * @Assert\LessThan("today")
     * @ORM\Column(name = "birthDate", type="date")
     */
    private $birthDate;

    /**
     * @ORM\Column(name = "genderId", type="integer")
     */
    private $genderId;
    /**
     * @Assert\NotBlank(message = "Моля, въведете година на завършване")
     * @Assert\LessThan(2018)(message = "Годината на завършване е по-малка от 2018")
     * @ORM\Column(name = "graduateYear", type="integer")
     */
     
    private $graduateYear;
    //private $nationality;
    /**
     * @ORM\Column(name = "phone", type="string", length=32)
     */
    private $phone;
    /**
     * @ORM\Column(name = "secondPhone", type="string", length=32)
     */
    private $secondPhone;
    /**
     * @ORM\Column(name = "gsm", type="string", length=32)
     */
    private $gsm;
    /**
     * @ORM\Column(name = "secondGsm", type="string", length=32)
     */
    private $secondGsm;
    //private $second_email;
    /**
     * @ORM\Column(name = "contactAddressId", type="integer")
     */
    private $contactAddressId;

    // function __construct(Student $student) {
    //     $this->student = $student;
    // }
    
    private $userId;
    /**
     *
     * @ORM\Column(name = "firstName", type="string", length=255)
    * @Assert\NotBlank(message = "Моля, въведете име")
    * @Assert\Regex(pattern     = "/[А-Яа-я]+$/i", message = "Моля, въведете името на кирилица")
    */
    private $firstName;
    /**
     * @ORM\Column(name = "middleName", type="string", length=255)
     * @Assert\NotBlank(message = "Моля, въведете презиме")
     * @Assert\Regex(pattern     = "/[А-Яа-я]+$/i", message = "Моля, въведете презимето на кирилица")
     */
    private $middleName;
    /**
     * @ORM\Column(name = "lastName", type="string", length=255)
     * @Assert\NotBlank(message = "Моля, въведете фамилия")
     * @Assert\Regex(pattern     = "/[А-Яа-я]+$/i", message = "Моля, въведете фамилията на кирилица")
     */
    private $lastName;
    /**
     * @ORM\Column(name = "otherName", type="string", length=255)
     * @Assert\Regex(pattern     = "/[А-Яа-я]+$/i", message = "Моля, въведете другото име на кирилица")
     */
    private $otherName;
    /**
     * @ORM\Column(name = "personalNumber", type="string", length=10)
     * @Assert\NotBlank(message = "Моля, въведете ЕГН")
     * @Assert\Regex(pattern="/\d/",
     *     match=true, message = "Моля, въведете ЕГН от цифри")
     * @Assert\Length(
     *      min = 10, max = 10,
     *      exactMessage = "ЕГН се състои от  10  цифри")
     * @AcmeAssert\egn
     */
    private $personalNumber;
    /**
     * @ORM\Column(name = "personalNumberType", type="integer")
     */
    private $personalNumberType;
    
    

    
    /**
     * @return integer 
     */
    public function getId() {
        return $this->id;
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
        $this->middlenName = $middleName;
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
    

    public function getBirthDate() {
        return $this->birthDate;
    }

    public function setBirthDate(DateTime $birthDate = null) {
        $this->birthDate = $birthDate;
        return $this;
    }

    public function getGender() {
        return $this->genderId;
    }

    public function setGender(Gender $gender = null) {
        $this->genderId = $gender;
        return $this;
    }

    /* public function getNationality() {
      return $this->nationality;
      }

      public function setNationality(Nationality $nationality = null) {
      $this->nationality = $nationality;
      return $this;
      } */

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

    public function getSecondEmail() {
        return $this->secondEmail;
    }

    public function setSecondEmail($secondEmail = null) {
        $this->secondEmail = $secondEmail;
        return $this;
    }

    /**
     * @return \Ucict\Bundle\StudentBundle\Entity\Address
     */
    public function getContactAddress() {
        return $this->contactAddressId;
    }

    public function setContactAddress(Address $contactAddress = null) {
        $this->contactAddressId = $contactAddress;
        return $this;
    }

    /**
     * @return Student
     */
    // public function getStudent() {
    //     return $this->student;
    // }

    public function getGraduateYear() {
        return $this->graduateYear;
    }

    public function setGraduateYear($graduateYear) {
        $this->graduateYear = $graduateYear;
        return $this;
    }

}
