<?php

namespace Services\validator\validators;

class RequiredValidator implements ValidatorInterface
{
    public function validate($value)
    {
        if (!$value) {
            return "This field is required";
        }

        return true;
    }
}
