<?php

try {
    $pdo = new PDO("mysql:host=localhost;dbname=test", 'root', 'root');
} catch (PDOException $e) {
    echo $e->getMessage();
    die;
}

// ** получение пользователя по id
$id = $_GET['id'] ?? 0;
if($id) {
    $ret = $pdo->query("SELECT * FROM `users` WHERE id=$id");

    if(!$ret) { //проверяем на успешность
        echo 'ERROR:';
        print_r($pdo->errorInfo()); die;
    }

    $user = $ret->fetchAll(PDO::FETCH_ASSOC);
}


// ** получение пользователя по почте
$id = $_GET['email'] ?? '';

if(!empty($_REQUEST['ajax'])) {
    header('Content-type: application/json');
    echo json_encode($user ? $user[0] : []);
}
