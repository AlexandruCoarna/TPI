<?php

namespace Services\Validator\Validators;

class PhoneNumber implements ValidatorInterface {
    public function validate($value) {
        $pattern = "/^\d{10}$/";

        if (!preg_match($pattern, $value)) {
            return "' $value ' is not a valid phone number.";
        }

        return true;
    }
}
