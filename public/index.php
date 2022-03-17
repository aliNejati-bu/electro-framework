<?php


// load constants
require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "Bootstrap" . DIRECTORY_SEPARATOR . "consts" . DIRECTORY_SEPARATOR . "main.php";

// load composer packages
require_once ELECTRO_BASE . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

// load bootstrap
require_once ELECTRO_BASE . DIRECTORY_SEPARATOR . "Bootstrap" . DIRECTORY_SEPARATOR . "Loader.php";

// boot framework
\Bootstrap\Loader::BOOT();

// call tester
\SandBox\Tester::main();