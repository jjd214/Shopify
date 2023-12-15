<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/e-commerce/controllers/functions.php';

require_once $_SERVER['DOCUMENT_ROOT'].'/e-commerce/vendor/autoload.php';

spl_autoload_register(function($class) {
    require_once $_SERVER['DOCUMENT_ROOT'].'/e-commerce/backend/'.$class.'.php';
});

?>