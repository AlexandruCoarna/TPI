<?php

namespace Core;

define("ROOT", $_SERVER['DOCUMENT_ROOT']);

function underscoreToNormal($value)
{
    $ucFirstArr = [];
    $explodedValue = explode("_", $value);

    foreach ($explodedValue as $val) {
        array_push($ucFirstArr, ucfirst($val));
    }

    unset($explodedValue);

    return implode(" ", $ucFirstArr);
}