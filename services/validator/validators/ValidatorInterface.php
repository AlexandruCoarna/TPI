<?php

namespace Services\Validator\Validators;

interface ValidatorInterface {
    /* @param $value
     * @return boolean | string
     */
    public function validate($value);
}