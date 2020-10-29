<?php
namespace App\Controller;

use App\Model\User as UserModel;
use Base\AbstractController;

class User extends AbstractController
{
    public function loginAction()
    {
        $name = trim($_POST['name']);

        if($name) {
            $password = $_POST['password'];
            $user = UserModel::getByName($name);
            if(!$user) {

            }

            if($user->getPassword() == UserModel::getPasswordHash($password)) {

            }

            $_SESSION['id'] = $user->getId();

            $this->redirect('/blog/index');
        }

        return $this->view->render('User/register.phtml', [
            'user' => UserModel::getById((int) $_GET['id'])
        ]);
    }

    function registerAction()
    {
        $names = ['Aglaya', "Zulfia", 'Azamat', 'Johnny', 'Sindbad', 'Alibaba', 'Ratatui', 'VolanDeMort'];

        $name = trim($_POST['name']);
        $email = 'doh@springfield.com';
        $password = 'donuts';

        $user = new UserModel();
        $user->setName($name)->setEmail($email)->setPassword(UserModel::getPasswordHash($password));

        $user->save();

        $this->redirect('/blog/index');
    }

    public function profileAction()
    {
        return $this->view->render('User/profile.phtml', [
            'user' => UserModel::getById((int) $_GET['id'])
        ]);
    }

}