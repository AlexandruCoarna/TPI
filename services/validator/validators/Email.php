<?php

namespace Services\Validator\Validators;

class Email implements ValidatorInterface {
    public function validate($value) {
        $pattern = "/^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/";

        if (!preg_match($pattern, $value)) {
            return "' $value ' is not a valid email.";
        }

        return true;
    }
}
