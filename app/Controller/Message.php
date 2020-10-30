<?php

namespace App\Controller;

use App\Model\Message as MessageModel;
use Base\AbstractController;
use Base\Db;

class Message extends AbstractController
{
    private $message;
    private $userId;
    private $date;

    public function sendPost()
    {
        $this->message = htmlspecialchars($_POST['message']);
        $this->userId = $_SESSION['user_id'];
        $this->date = date('Y-m-d H:i:s');

        $db = Db::getInstance();
        $select = "
        INSERT
            INTO posts
            (
                user_id,
                message,
                `datetime`
            )
            VALUES
            (
                :userId,
                :placeholder,
                :date
            );";
        $data = $db->fetchOne($select, __METHOD__, [
            ':userId' => $this->userId,
            ':message' => $this->message,
            ':date' => $this->date
        ]);

        $postId = $db->lastInsertId();
        if (!empty($_FILES['userfile']['tmp_name'])) {
            $fileContent = file_get_contents($_FILES['userfile']['tmp_name']);
            file_put_contents('../../images/'. $postId . '.png', $fileContent);
        }
    }

    public function pushMessage()
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM posts ORDER BY id DESC LIMIT 10";
        $data = $db->fetchOne($select, __METHOD__);

        if (!$data) {
            echo 'error';
            die;
        }

        $postUserIds = array_column($data, 'user_id');
        $userIdsStr = implode(',', array_unique($postUserIds));
        $result = "SELECT * FROM users WHERE id IN($userIdsStr)";
        $users = $db->fetchAll($result, __METHOD__);

        // создаем массив пользователей, в котором ключ - идентификатор пользователя
        $usersById = array_combine(
            array_column($users, 'id'),
            $users
        );
    }

    public function save()
    {
    }
}