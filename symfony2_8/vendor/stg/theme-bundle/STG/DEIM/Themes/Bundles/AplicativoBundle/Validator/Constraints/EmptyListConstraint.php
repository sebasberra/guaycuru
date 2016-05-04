<?php
namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class EmptyListConstraint extends Constraint
{

    public $message = 'La lista no puede ser vacía. Debe tener al menos un elemento.';

    public function validatedBy()
    {
        return get_class($this) . 'Validator';
    }
}
