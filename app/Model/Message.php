<?php
namespace App\Model;

use Base\AbstractModel;
use Base\Db;

class Message
{
    private $id;
    private $userId;
    private $message;
    private $createdAt;
    /**
     * @var User
     */
    private $author;
    private $image;

    public function __construct($data = [])
    {
        if($data){
            $this->id = $data['id'];
            $this->userId = $data['user_id'];
            $this->message = $data['message'];
            $this->createdAt = $data['created_at'];
            $this->image = $data['image'] ?? '';
        }
    }

    public static function deleteMessage(int $messageId)
    {
        $db = Db::getInstance();
        $query = "DELETE FROM messages WHERE id = $messageId";
        return $db->exec($query, __METHOD__);
    }

    public function save()
    {
        $db = Db::getInstance();
        $insert = "INSERT INTO posts (`user_id`, `message`, `created_at`) VALUES (
            :user_id, :message, :created_at, :image
        )";
        $res = $db->exec($insert, __METHOD__, [
            ':user_id' => $this->userId,
            ':message' => $this->message,
            ':created_at' => $this->createdAt,
            ':image' => $this->image
        ]);

        return $res;
    }

    public static function getList(int $limit = 10, int $offset = 0): array
    {
        $db = Db::getInstance();
        $data = $db->fetchAll(
            "SELECT * FROM posts LIMIT $limit OFFSET $offset",
            __METHOD__
        );

        if(!$data) {
            return [];
        }

        $messages = [];
        foreach($data as $elem) {
            $message = new self($elem);
            $message->id = $elem['id'];
            $messages[] = $message;
        }

        return $messages;
    }

    public static function getUserMessages(int $userId, int $limit): array
    {
        $db = Db::getInstance();
        $data = $db->fetchAll(
            "SELECT * fROM messages WHERE user_id = $userId LIMIT $limit",
            __METHOD__
        );
        if (!$data) {
            return [];
        }

        $messages = [];
        foreach ($data as $elem) {
            $message = new self($elem);
            $message->id = $elem['id'];
            $messages[] = $message;
        }

        return $messages;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->userId;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    /**
     * @param User $author
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    public function loadFile(string $file)
    {

        if(file_exists($file)){
            $this->image = $this->genFileName();
            move_uploaded_file($file,getcwd() . '/images' . $this->image);
        }
    }

    private function genFileName()
    {
        return sha1(microtime(1) . mt_rand(1, 100000000)) . '.jpg';
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    public function getData()
    {
        return [
            'id' => $this->id,
            'author_id' => $this->authorId,
            'text' => $this->text,
            'created_at' => $this->createdAt,
            'image' => $this->image
        ];
    }
}