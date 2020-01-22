<?php

use Core\Container;
use Services\Validator\FormValidator;

Container::register("formValidator", new FormValidator());
