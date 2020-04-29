<?php

namespace Services\validator\validators;

interface ValidatorInterface {
    /* @param $value
     * @return boolean | string
     */
    public function validate($value);
}