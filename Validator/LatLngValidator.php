<?php
namespace Rz\FieldTypeBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class LatLngValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!preg_match('/^[0-9\-\.]+$/', $value['lat'], $matches) || !preg_match('/^[0-9\-\.]+$/', $value['lng'], $matches)) {

            if ($this->context instanceof ExecutionContextInterface) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ lat }}', (float)$value['lat'])
                    ->setParameter('{{ lng }}', (float)$value['lng'])
                    ->addViolation();
            } else {
                $this->context->addViolation($constraint->message, array('%lat%' => (float)$value['lat'], '%lng%' => (float)$value['lng']));
            }

            return false;
        }
        if($value['lat'] > 90 || $value['lat'] < -90 || $value['lng'] > 180 || $value['lng'] < -180)
        {
            if ($this->context instanceof ExecutionContextInterface) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{ lat }}', (float)$value['lat'])
                    ->setParameter('{{ lng }}', (float)$value['lng'])
                    ->addViolation();
            } else {
                $this->context->addViolation($constraint->message, array('%lat%' => (float)$value['lat'], '%lng%' => (float)$value['lng']));
            }

            return false;
        }
        return true;
    }
}