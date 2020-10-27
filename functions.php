<?php

function isUserAuthorized(): bool
{
    return isset($_SESSION['user_id']);
}

function getPasswordHash(string $userPassword):string
{
    //хэширование пароля с "солью(рандомный набор символов"
    return sha1($userPassword . 'gst4ff,weg.%ehf#fd');

}

function getUserByLogin(string $login) use ($_DB_CONNECTION): array
{

}