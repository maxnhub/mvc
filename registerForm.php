<?php

require_once 'init.php';

if(!isUserAuthorized()) {
    header('Location: index.php');
    die;
};
?>

<h1>'Register and login form';</h1>
<br><br>

Register:<br>
<form action="register.php" method="post">
    Login: <input type="text" name="login" value=""><br>
    Password: <input type="text" name="password" value="">
    <input type="submit" value="Register"><br>
</form>
<br><br><br>

Auth:<br><br>
<form action="auth.php" method="post">
    Login: <input type="text" name="login" value=""><br>
    Password: <input type="text" name="password" value="">
    <input type="submit" value="Login"><br>
</form>