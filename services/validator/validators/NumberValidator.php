<?php

namespace Services\Validator\Validators;

class NumberValidator implements ValidatorInterface {
    public function validate($value) {
        $pattern = "/^[0-9]+$/";

        if (!preg_match($pattern, $value)) {
            return "This field must contain only digits";
        }

        return true;
    }
}
