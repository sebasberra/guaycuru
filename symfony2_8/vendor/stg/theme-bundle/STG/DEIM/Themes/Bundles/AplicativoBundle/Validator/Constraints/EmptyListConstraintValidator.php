<?php
namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class EmptyListConstraintValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if (! $value || empty($value)) {
            $this->context->addViolation($constraint->message, array(
                '%string%' => $value
            ));
        }
    }
}
