<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
