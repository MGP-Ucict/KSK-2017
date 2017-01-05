<?php
// src/Ucict/Bundle/StudentBundle/Validator/Constraints/EGN.php
namespace Ucict\Bundle\StudentBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class EGN extends Constraint
{
    public $message = 'Невалидно ЕГН';
}