<?php
namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Services;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintViolationList;

class ValidatorService
{

    protected $validator;

    public function __construct($validator)
    {
        $this->validator = $validator;
    }

    public function validateByConstraint($value, Constraint $constraint)
    {
        return $this->validator->validateValue($value, $constraint);
    }

    public function getConstraintViolationsString(ConstraintViolationList $constraintViolations)
    {
        $mensaje = '';
        foreach ($constraintViolations as $cv) {
            $mensaje .= $cv->getMessage() . ' ';
        }
        
        return $mensaje;
    }

    public function getStringValidationByConstraint($value, Constraint $constraint)
    {
        $violations = $this->validateByConstraint($value, $constraint);
        
        if (count($violations) == 0) {
            return false;
        }
        
        return $this->getConstraintViolationsString($violations);
    }
}
