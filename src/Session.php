<?php
namespace Base;

class Session
{
    public function authUser(int $id)
    {
        $_SESSION['user_id'] = $id;
    }

    public function getUserId()
    {
        return $_SESSION['user_id'] ?? false;
    }
}
