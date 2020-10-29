<?php
namespace App\Model;

use Base\AbstractModel;
use Base\Db;

class User extends AbstractModel
{
    private $id;
    private $name;
    private $email;
    private $createdAt;
    private $password;

    public function __construct($data = [])
    {
        if($data){
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->createdAt = $data['created_at'];
            $this->password = $data['password'];
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId(int $id)
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function save()
    {
        $db = Db::getInstance();
        $insert = "INSERT INTO users (`name`, `email`, `password`) VALUES (
            :name, :email, :password
        )";
        $db->exec($insert, __METHOD__, [
            ':name' => $this->name,
            ':email' => $this->email,
            ':password' => $this->password
        ]);

        $id = $db->lastInsertId();
        $this->id = $id;

        return $id;
    }

    public static function getById(int $id): ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE id = $id";
        $data = $db->fetchOne($select, __METHOD__);

        if(!$data) {
            return null;
        }

        return new self($data);

    }

    public static function getByName(string $name): ?self
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE `name` = :name";
        $data = $db->fetchOne($select, __METHOD__, [
            ':name' => $name
        ]);

        if(!$data) {
            return null;
        }

        return new self($data);

    }


    public static function getPasswordHash(string $password): string
    {
        return sha1($password . 'gst4ff,weg.%ehf#fd');
    }

}