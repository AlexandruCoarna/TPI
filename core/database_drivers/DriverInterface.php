<?php

namespace Core\database_drivers;

interface DriverInterface
{
    public static function connect(array $config);
}
