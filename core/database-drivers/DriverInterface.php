<?php

namespace Core\DatabaseDrivers;

interface DriverInterface
{
    public static function connect(array $config);
}
