<?php

namespace Services\Validator\Validators;

class EmailValidator implements ValidatorInterface {
    public function validate($value) {
        $pattern = "/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/";

        if (!preg_match($pattern, $value)) {
            return "Invalid email address";
        }

        return true;
    }
}
