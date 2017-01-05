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
     */
    private $birthdate;

    private $genderid;
    /**
     * @Assert\NotBlank(message = "Моля, въведете година на завършване")
     * @Assert\LessThan(2018)(message = "Годината на завършване е по-малка от 2018")
     */
    private $graduateyear;
    //private $nationality;
    private $phone;
    private $secondphone;
    private $gsm;
    private $secondgsm;
    //private $second_email;
    private $contactaddressid;

    // function __construct(Student $student) {
    //     $this->student = $student;
    // }
    
    private $userid;
    /**
     *
    * @Assert\NotBlank(message = "Моля, въведете име")
    * @Assert\Regex(pattern     = "/[А-Яа-я]+$/i", message = "Моля, въведете името на кирилица")
    */
    private $firstname;
    /**
     * @Assert\NotBlank(message = "Моля, въведете презиме")
     * @Assert\Regex(pattern     = "/[А-Яа-я]+$/i", message = "Моля, въведете презимето на кирилица")
     */
    private $middlename;
    /**
     * @Assert\NotBlank(message = "Моля, въведете фамилия")
     * @Assert\Regex(pattern     = "/[А-Яа-я]+$/i", message = "Моля, въведете фамилията на кирилица")
     */
    private $lastname;
    /**
     * @Assert\Regex(pattern     = "/[А-Яа-я]+$/i", message = "Моля, въведете другото име на кирилица")
     */
    private $othername;
    /**
     * @Assert\NotBlank(message = "Моля, въведете ЕГН")
     * @Assert\Regex(pattern="/\d/",
     *     match=true, message = "Моля, въведете ЕГН от цифри")
     * @Assert\Length(
     *      min = 10, max = 10,
     *      exactMessage = "ЕГН се състои от  10  цифри")
     * @AcmeAssert\egn
     */
    private $personalnumber;
    /**
     *
     */
    private $personalnumbertype;
    
    

    
    /**
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }
    
    
    
    
    public function getFirstName() {
        return $this->firstname;
    }

    public function setFirstName($firstName) {
        $this->firstname = $firstName;
        return $this;
    }

    public function getMiddleName() {
        return $this->middlename;
    }

    public function setMiddleName($middleName = null) {
        $this->middlename = $middleName;
        return $this;
    }

    public function getLastName() {
        return $this->lastname;
    }

    public function setLastName($lastName) {
        $this->lastname = $lastName;
        return $this;
    }

    public function getOtherName() {
        return $this->othername;
    }

    public function setOtherName($otherName) {
        $this->othername = $otherName;
        return $this;
    }

    public function getPersonalNumber() {
        return $this->personalnumber;
    }

    public function setPersonalNumber($personalNumber = null) {
        $this->personalnumber = $personalNumber;
        return $this;
    }

    public function getPersonalNumberType() {
        return $this->personalnumbertype;
    }

    public function setPersonalNumberType(
    //PersonalNumberType 
    $personalNumberType) {
        $this->personalnumbertype = $personalNumberType;
        return $this;
    }
    

    public function getBirthDate() {
        return $this->birthdate;
    }

    public function setBirthDate(DateTime $birthDate = null) {
        $this->birthdate = $birthDate;
        return $this;
    }

    public function getGender() {
        return $this->genderid;
    }

    public function setGender(Gender $gender = null) {
        $this->genderid = $gender;
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
        return $this->secondphone;
    }

    public function setSecondPhone($secondPhone = null) {
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

    public function getSecondGsm() {
        return $this->secondgsm;
    }

    public function setSecondGsm($secondGsm = null) {
        $this->secondgsm = $secondGsm;
        return $this;
    }

    public function getSecondEmail() {
        return $this->secondemail;
    }

    public function setSecondEmail($secondEmail = null) {
        $this->secondemail = $secondEmail;
        return $this;
    }

    /**
     * @return \Ucict\Bundle\StudentBundle\Entity\Address
     */
    public function getContactAddress() {
        return $this->contactaddressid;
    }

    public function setContactAddress(Address $contactAddress = null) {
        $this->contactaddressid = $contactAddress;
        return $this;
    }

    /**
     * @return Student
     */
    // public function getStudent() {
    //     return $this->student;
    // }

    public function getGraduateYear() {
        return $this->graduateyear;
    }

    public function setGraduateYear($graduateYear) {
        $this->graduateyear = $graduateYear;
        return $this;
    }

}
