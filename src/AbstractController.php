<?php
namespace Base;

use App\Model\User;

abstract class AbstractController
{
    /**
     * @var View
     */
    protected $view;
    /**
     * @var Session
     */
    protected $session;
    /**
     * @var User
     */
    protected $user;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function getUser(): ?User
    {

        if ($this->session === null) {
            return null;
        }

        $userId = $this->session->getUserId();
        $user = User::getById($userId);
        if (!$user) {
            return null;
        }

        return $user;
    }

    public function getUserId()
    {
        if ($user = $this->getUser()) {
            return $user->getId();
        }

        return false;
    }

    public function setSession(Session $session)
    {
        $this->session = $session;
    }

    protected function redirect(string $url)
    {
        header('Location: ' . $url);
        exit;
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

}