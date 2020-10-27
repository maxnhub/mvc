<?php

require_once 'init.php';

if(!isUserAuthorized()) {
    header('Location: index.php');
    die;
};

$name = $_POST['login'];
$originalPassword = $_POST['password'];
$password = getPasswordHash($originalPassword);


$query = "INSERT INTO users (`name`, `password`, `email`) VALUES ('$name', '$password', 'default@gmail.com')";
$ret = getDbConnection()->query($query);

if($ret) {
    echo 'User created';
} else {
    echo $query . '<br>';
    var_dump(getDbConnection()->errorInfo());
    echo 'Error';
}
?>