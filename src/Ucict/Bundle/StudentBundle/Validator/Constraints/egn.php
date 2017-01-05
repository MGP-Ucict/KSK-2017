<?php
// src/Ucict/Bundle/StudentBundle/Validator/Constraints/EGN.php
namespace Ucict\Bundle\StudentBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class egn extends Constraint
{
    public $message = 'Невалидно ЕГН';

    public function validatedBy()
{
    return get_class($this).'Validator';
}
}