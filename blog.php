<?php
$DB = getDbConnection();
$result = $DB->query("SELECT * FROM posts ORDER BY id DESC LIMIT 10");
if (!$result) {
    echo 'error';
    die;
}

$posts = $result->fetchAll(PDO::FETCH_ASSOC);
if (!$posts) {
    echo 'no posts';
    die;
}

$postUserIds = array_column($posts, 'user_id');
$userIdsStr = implode(',', array_unique($postUserIds));
$result = $DB->query("SELECT * FROM users WHERE id IN($userIdsStr)");
$users = $result->fetchAll(PDO::FETCH_ASSOC);

// создаем массив пользователей, в котором ключ - идентификатор пользователя
$usersById = array_combine(
    array_column($users, 'id'),
    $users
);

?>

<? // для работы сокращенных дескрипторов требуется short_open_tag = On в php.ini ?>
<? foreach ($posts as $post): ?>
    <div class="post">
        <span class="user">Сообщеие от <b><?=strip_tags($usersById[$post['user_id']]['name']);?></b> отправлено <?=$post['datetime'];?></span>
        <div class="message"><?=$post['message'];?></div>
        <? if (file_exists('../../images/' . $post['id'] . '.png')):?>
            <img src="image.php/?id=<?=$post['id'];?>"></img>
        <? endif; ?>
    </div>
<? endforeach;?>

<style>
    .post {
        border: 1px solid grey;
        margin-top: 10px;
        padding: 5px;
        width: 250px;
    }
    .user {
        color: grey;
        font-size: 11px;
    }
    .message {
        margin-top: 5px;
        padding-left: 5px;
    }
</style>