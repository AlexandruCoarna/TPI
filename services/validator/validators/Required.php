<?php

namespace Services\Validator\Validators;

class Required implements ValidatorInterface {
    public function validate($value) {
        if (!$value) {
            return "You inserted an empty value.";
        }

        return true;
    }
}