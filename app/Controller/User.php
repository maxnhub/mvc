<?php
namespace App\Controller;

use App\Model\User as UserModel;
use Base\AbstractController;

class User extends AbstractController
{
    function loginAction()
    {
        echo __METHOD__;
    }

    function registerAction()
    {
        $names = ['Aglaya', "Zulfia", 'Azamat', 'Johnny', 'Sindbad', 'Alibaba', 'Ratatui', 'VolanDeMort'];

        $name = $names[array_rand($names)];
        $email = 'doh@springfield.com';
        $password = 'donuts';

        $user = new UserModel();
        $user->setName($name)->setEmail($email)->setPassword(UserModel::getPasswordHash($password));

        $userId = $user->save();

        return $this->view->render('User/register.phtml', [

        ]);
    }

}