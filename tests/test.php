<?php

use function Piewpiew\piewpiew;

require_once __DIR__ . '/../vendor/autoload.php';

define("_ds_", DIRECTORY_SEPARATOR);

define("PIEWPIEW_CONFIG", __DIR__ . _ds_ . "config");
define("TESTS_DIR", __DIR__);

piewpiew('test');
