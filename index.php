<?php

require_once 'init.php';

//Код для неавторизованного пользователя
if (!isUserAuthorized()) {
    // user not authorized
    header('Location: registerForm.php');
    die;
}

echo 'Пользователь авторизован<br>';
// User authorized
echo 'You ID is = ' . $_SESSION['user_id'];

if (!empty($_GET['authorized'])) {
    echo 'You just successfully authorized';
}


include "postForm.php";
echo '<br><hr><br>';
include "blog.php";