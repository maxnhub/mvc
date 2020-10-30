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

        $posts = [];
        foreach($data as $elem) {
            $post = new self($elem);
            $post->id = $elem['id'];
            $posts[] = $post;
        }

        return $posts;
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
    public function getTextMessage(): string
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getUserId()
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


}