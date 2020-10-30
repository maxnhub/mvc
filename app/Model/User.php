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
    private $password2;

    public function __construct($data = [])
    {
        if($data){
            $this->id = $data['id'];
            $this->name = $data['name'];
            $this->email = $data['email'];
            $this->createdAt = $data['created_at'];
            $this->password = $data['password'];
            $this->password2 = $data['password_2'];
        }
    }

    public static function getByIds(array $userIds)
    {
        $db = Db::getInstance();
        $idsString = implode(',', $userIds);
        $data = $db->fetchAll(
            "SELECT * FROM users LIMIT id IN($idsString)",
            __METHOD__
        );

        if(!$data) {
            return [];
        }

        $users = [];
        foreach($data as $elem) {
            $user = new self($elem);
            $user->id = $elem['id'];
            $users[$user->id] = $user;
        }

        return $users;
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
    public function getId()
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
    public function getPassword2()
    {
        return $this->password2;
    }

    /**
     * @param mixed $password2
     */
    public function setPassword2($password2): self
    {
        $this->password2 = $password2;
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

    public static function getById($id): ?self
    {
        if($id < 1) {
            return null;
        }
        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE id = :id";
        $data = $db->fetchOne($select, __METHOD__, [
            ':id' => $id
        ]);

        if(!$data) {
            return null;
        }

        return new self($data);

    }

    public static function getList(int $limit = 10, int $offset = 0): array
    {
        $db = Db::getInstance();
        $data = $db->fetchAll(
            "SELECT * FROM users LIMIT $limit OFFSET $offset",
            __METHOD__
        );

        if(!$data) {
            return [];
        }

        $users = [];
        foreach($data as $elem) {
            $user = new self($elem);
            $user->id = $elem['id'];
            $users[] = $user;
        }

        return $users;
    }

    public static function getByName(string $name): ?self
    {

        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE `name` = :name";
        $data = $db->fetchOne($select, __METHOD__, [
            ':name' => $name
        ]);

        if(empty($data['id'])) {
            return null;
        }

        return new self($data);

    }

    public function login(string $name, string $password): bool
    {
        $db = Db::getInstance();
        $select = "SELECT * FROM users WHERE `name` = :name AND `password` = :password";
        $data = $db->fetchOne($select, __METHOD__, [
            ':name' => $name,
            ':password' => $password
        ]);

        if(empty($data['id'])) {
            return false;
        }

        return true;

    }


    public static function getPasswordHash(string $password): string
    {
        return sha1($password . 'gst4ff,weg.%ehf#fd');
    }

    public static function getPasswordHashConfirm(string $password2): string
    {
        return sha1($password2 . 'gst4ff,weg.%ehf#fd');
    }

}

// static
// Db переписать на getDb