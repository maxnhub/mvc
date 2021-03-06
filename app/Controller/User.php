<?php

namespace App\Controller;

use App\Model\User as UserModel;
use Base\AbstractController;

class User extends AbstractController
{
    public function loginAction()
    {

        if (empty($_POST['name'])) {
            return $this->view->render('User/register.phtml', [
                'user' => UserModel::getById((int)$_GET['id'])
            ]);
        }
        $name = trim($_POST['name']);
        $password = $_POST['password'];

        $user = (new UserModel)->getByName($name, UserModel::getPasswordHash($password));

        if ($user) {
            $this->session->authUser($user->getId());
            $this->redirect('/');
        }

        $this->view->assign('error', 'Неверный логин и пароль');

        return $this->view->render('User/register.phtml', [
            'user' => UserModel::getById((int)$_GET['id'])
        ]);
    }

    function registerAction()
    {

        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $success = true;

        if (isset($_POST['name'])) {
            if (!$name) {
                $this->view->assign('error', 'Поле с именем не может быть пустым');
                $success = false;
            }

            if (!$password) {
                $this->view->assign('error', 'Поле с паролем не может быть пустым');
                $success = false;
            }

            $user = UserModel::getByName($name);
            if ($user) {
                $this->view->assign('error', 'Пользователь с таким именем уже существует');
                $success = false;
            }

            if ($success) {
                $user = new UserModel();
                $user->setName($name)->setEmail($email)->setPassword(UserModel::getPasswordHash($password));

                $user->save();

                $_SESSION['id'] = $user->getId();
                $this->setUser($user);

                $this->redirect('/');
            }
        }

        return $this->view->render('User/register.phtml', [
            'user' => UserModel::getById((int)$_GET['id'])
        ]);
    }

    public function profileAction()
    {
        return $this->view->render('User/profile.phtml', [
            'user' => UserModel::getById((int)$_GET['id'])
        ]);
    }

    public function logoutAction()
    {
        session_destroy();

        $this->redirect('/user/login');

    }

}