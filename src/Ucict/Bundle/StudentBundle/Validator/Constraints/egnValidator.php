<?php
// src/AppBundle/Validator/Constraints/EGNValidator.php
namespace Ucict\Bundle\StudentBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;


class egnValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$this->validateEGN($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('%string%', $value)
                ->addViolation();
        }
    }

    protected function validateEGN($egn) {
		if (!preg_match('#[0-9]{10}#', $egn)) {
			return false;
		}
		$data = preg_split("//u", $egn, -1, PREG_SPLIT_NO_EMPTY);
		if (count($data) !== 10) {
			return false;
		}
		$result = 0;
		$weight = array(2, 4, 8, 5, 10, 9, 7, 3, 6);
		$egnYear = intval(substr($egn, 0, 2));
		$egnMonth = intval(substr($egn, 2, 2));
		$egnDay = intval(substr($egn, 4, 2));
		if ($egnMonth >= 1 && $egnMonth <= 12) {
			$egnYear += 1900;
		} else if ($egnMonth >= 41 && $egnMonth <= 52) {
			$egnYear += 2000;
			$egnMonth -= 40;
		} else {
			return false; //Без проверка за родените преди 1900, считаме че няма такива.
		}

		$days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
		if (($egnYear % 400) == 0 || ($egnYear % 100) !== 0 && ($egnYear % 4) === 0) {
			$days[1] = 29;
		}

		if ($egnDay < 1 || $egnDay > $days[$egnMonth - 1]) {
			return false;
		}

		$control = intval(array_pop($data));
		foreach ($data as $index => $char) {
			$result += $weight[$index] * intval($char);
		}
		$result = $result % 11;
		if ($result === 10) {
			$result = 0;
		}
		return $result === $control;
	}

}