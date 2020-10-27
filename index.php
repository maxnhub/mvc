<?php

//ini_set('display_errors', 'on');
//ini_set('error_reporting', E_NOTICE | E_ALL);

require_once 'init.php';

//Код для неавторизованного пользователя
if(isUserAuthorized()) {
    header('Location: registerForm.php');
    die;
};

//Код для авторизованного пользователя
?>

<h1>fhghg</h1>