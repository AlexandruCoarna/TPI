<?php

use Core\Container;
use Services\validator\FormValidator;

Container::register("formValidator", new FormValidator());
