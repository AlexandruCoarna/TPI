<?php

namespace Services\Validator;

use Core\Container;
use PDO;
use Services\Validator\Validators\{ValidatorInterface};
use function Core\underscoreToNormal;

class FormValidator {

    use ValidatorList;

    private array $errors = [];

    public function validate(string $control, $value, array $validators) {
        foreach ($validators as $validator) {
            /* @var $validator ValidatorInterface */

            $valid = $validator->validate($value);

            if ($valid !== true) {
                $this->errors[$control][] = $valid;
            }
        }
    }

    public function checkControlAlreadyExists(string $table, array $columns, array $values, array $controls = []) {
        /* @var $conn PDO */

        if (!count($controls)) {
            $controls = $columns;
        }

        $partial = '';

        foreach ($columns as $key => $value) {
            $partial .= "$value = ?";

            if ($key + 1 < count($columns)) {
                $partial .= " OR ";
            }
        }

        $sql = "SELECT * FROM $table WHERE $partial limit 1";

        $conn = Container::get("database")->getConnection();
        $stm = $conn->prepare($sql);
        $stm->execute($values);
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        if (count($result)) {
            foreach ($columns as $key => $value) {
                if ($result[0][$value] === $values[$key]) {
                    $controlName = underscoreToNormal($controls[$key]);
                    $this->errors[$controls[$key]][] = "This $controlName is already used!";
                }
            }
        }
    }

    public function getErrors() {
        return $this->errors;
    }
}