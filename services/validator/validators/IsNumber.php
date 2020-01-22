<?php

namespace Services\Validator\Validators;

class IsNumber implements ValidatorInterface {
    public function validate($value) {
        $pattern = "/^[0-9]+$/";

        if (!preg_match($pattern, $value)) {
            return "'$value' is not a valid number.";
        }

        return true;
    }
}