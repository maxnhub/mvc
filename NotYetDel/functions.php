<?php

//function isUserAuthorized(): bool
//{
//    return isset($_SESSION['user_id']);
//}
//
//function getPasswordHash(string $userPassword):string
//{
//    //хэширование пароля с "солью(рандомный набор символов"
//    return sha1($userPassword . 'gst4ff,weg.%ehf#fd');
//
//}
//
//
//function getUserByLogin(string $login): array
//{
//    $query = "SELECT * FROM users WHERE `name` = '$login' LIMIT 1";
//    $ret = getDbConnection()->query($query);
//    $users =  $ret->fetchAll();
//    return $users[0] ?? [];
//    //return !empty($users[0] ? $users[0] : []); - тоже самое, что и запись выше
//}