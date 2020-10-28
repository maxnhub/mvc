<?php
//require_once 'init.php';
//
//if (isUserAuthorized()) {
//    // user not authorized
//    header('Location: index.php');
//    die;
//}
//
//$name = $_POST['login'];
//$originalPassword = $_POST['password'];
//$password = getPasswordHash($originalPassword);
//
//if (getUserByLogin($name)) {
//    echo 'User with the same name already exists';
//    die;
//}
//
//$query = "INSERT INTO users (`name`, `password`, email) VALUES (:userName, :userPass, 'default@gmail.com');";
////$ret = getDbConnection()->query($query);
//
//$prepared = $DB->prepare($query);
//$ret = $prepared->execute(['userName' => $name, 'userPass' => $password]);
//
//if ($ret) {
//    echo 'User created';
//} else {
//
//    echo $query . '<br>';
//    echo 'Error';
//}
//?>