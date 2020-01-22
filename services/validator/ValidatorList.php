<?php

namespace Services\Validator;

use Services\Validator\Validators\{Email, IsNumber, PhoneNumber, Required};

trait ValidatorList {
    public function phoneNumber() {
        return new PhoneNumber();
    }

    public function email() {
        return new Email();
    }

    public function required() {
        return new Required();
    }

    public function number() {
        return new IsNumber();
    }
}
