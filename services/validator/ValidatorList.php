<?php

namespace Services\Validator;

use Services\Validator\Validators\{EmailValidator, NumberValidator, PhoneNumberValidator, RequiredValidator};

trait ValidatorList {
    public function phoneNumber() {
        return new PhoneNumberValidator();
    }

    public function email() {
        return new EmailValidator();
    }

    public function required() {
        return new RequiredValidator();
    }

    public function number() {
        return new NumberValidator();
    }
}
