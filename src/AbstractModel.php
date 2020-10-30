<?php
namespace Base;

abstract class AbstractModel
{

}

//abstract class AbstractModel
//{
//    private $pdo;
//
//    public function getDb(): \PDO
//    {
//        if($this->pdo !== null) {
//            return $this->pdo;
//        }
//
//        $this->pdo = new \PDO(
//            "mysql:host=" . HOST .";dbname=" . DBNAME,
//            DBUSER,
//            DBPASSWORD,
//            [
//                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
//            ]
//        );
//
//        return $this->pdo;
//    }
//}