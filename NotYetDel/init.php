<?php

//// в этот момент на сервере создается текстовый файл с сессией пользователя,а самому пол-лю устанавливается, отправляется кука
//session_start();
//
//require_once 'functions.php';
//require_once 'config.php';
//
///**
// * @return PDO
// */
//function getDbConnection(): PDO
//{
//    static $DB;
//    if(!$DB) {
//        try {
//            $DB = new PDO('mysql:host=' . HOST . ';dbname=' . DBNAME, DBUSER, DBPASSWORD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
//        } catch(PDOException $e) {
//            print "Возникла ошибка соединения!: " . $e->getMessage() . '<br>';
//            die();
//        }
//    }
//
//    return $DB;
//}



