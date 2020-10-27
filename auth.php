<?php
require_once 'init.php';

if (isUserAuthorized()) {
    // user not authorized
    header('Location: index.php');
    die;
}

$login = $_POST['login'];
$user = getUserByLogin($login);
if (!$user) {
    echo 'No user with this login and password 123';
    die;
}

$gotPassword = $_POST['password'];
$passwordHash = getPasswordHash($gotPassword);

if ($passwordHash !== $user['password']) {
    echo 'No user with this login and password 456';
    die;
}

$_SESSION['user_id'] = $user['id'];
header('Location: index.php?authorized=1');