<?php

namespace Services\Validator\Validators;

class PhoneNumberValidator implements ValidatorInterface {
    public function validate($value) {
        $pattern = "/^\d{10}$/";

        if (!preg_match($pattern, $value)) {
            return "Phone number must be a 10 digit long string with no spaces or any other characters";
        }

        return true;
    }
}
