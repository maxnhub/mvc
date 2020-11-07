<?php
namespace App\Controller;

use App\Model\Message as MessageModel;
use App\Model\User as UserModel;
use Base\AbstractController;

class Blog extends AbstractController
{
    function indexAction()
    {
        if(!$this->getUser()) {
            $this->redirect('/user/register');
        }
        $messages = MessageModel::getList();
        if($messages) {
            $userIds = array_map(function(MessageModel $message) {
                return $message->getAuthorId();
            }, $messages);
            $users = UserModel::getByIds($userIds);
            array_walk($messages, function(MessageModel $message) use ($users){
                if(isset($users[$message->getAuthorId()])) {
                    $message->setAuthor($users[$message->getAuthorId()]);
                }

            });
        }
        return $this->view->render('Blog/index.phtml', [
            'users' => $users,
            'user' => $this->user,
            'messages' => $messages
        ]);

    }

    public function addMessage()
    {
        if(!$this->getUser()){
            $this->redirect('/user/register');
        }

        $text = (string) $_POST['message'];
        if(!$text) {
            $this->error('Сообщение не может быть пустым');
        }

        $message = new Message([
            'text' => $text,
            'user_id' => $this->getUserId(),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        if(isset($_FILES['image']['tmp_name'])){
            $message->loadFile($_FILES['image']['tmp_name']);
        }


        $message->save();
        $this->redirect('blog/index');
    }

    public function twig()
    {
        return $this->view->renderTwig('Blog/test.twig', ['something' => 'thing']);
    }

    private function error()
    {

    }
}