<?php

echo 'Hello World<br>';

//var_export($_SERVER);

require_once 'route.php';

$page = $route[$_SERVER['REQUEST_URI']];

require_once $page;
