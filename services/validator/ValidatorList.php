<?php

namespace Services\Validator;

use Services\Validator\Validators\{Email, IsNumber, PhoneNumber, Required};

trait ValidatorList {
    public function phoneNumberValidator() {
        return new PhoneNumber();
    }

    public function emailValidator() {
        return new Email();
    }

    public function requiredValidator() {
        return new Required();
    }

    public function numberValidator() {
        return new IsNumber();
    }
}