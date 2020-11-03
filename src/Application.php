<?php
namespace Base;

use App\Controller\Blog;
use App\Controller\User;

class Application
{
    private $route;
    /**
     * @var AbstractController
     */
    private $controller;
    private $actionName;

    public function __construct()
    {
        $this->route = new Route();
    }

    public function run()
    {
        try {
            session_start();

            $this->addRoutes();
            $this->initController();
            $this->initAction();

            $view = new View();
            $this->controller->setView($view);
            $this->initUser();

            $content = $this->controller->{$this->actionName}();

            echo $content;

        } catch (RouteException $e) {
            header("HTTP/1.0 404 Not Found");
        }
    }

    private function initUser()
    {
        $id = $_SESSION['id'] ?? null;
        $user = \App\Model\User::getById($id);
        if($id){
            $this->controller->setUser($user);
        }
    }

    private function addRoutes()
    {
        /**
         * @uses \App\Controller\User::loginAction()
         */
        $this->route->addRoute('/user/login', User::class, 'login');
        /**
         * @uses \App\Controller\User::registerAction()
         */
        $this->route->addRoute('user/register', User::class, 'register');
        /**
         * @uses \App\Controller\Blog::indexAction()
         */
        $this->route->addRoute('/', Blog::class, 'index');
    }

    private function initController()
    {
        $controllerName = $this->route->getControllerName();
        if(!class_exists($controllerName)) {
            throw new RouteException('Cant find controller ' . $controllerName);
        }

        $this->controller = new $controllerName();
    }

    private function initAction()
    {
        $actionName = $this->route->getActionName();
        if(!method_exists($this->controller, $actionName)) {
            throw new RouteException('Action ' . ' not found in ' . get_class($this->controller));
        }

        $this->actionName = $actionName;
    }
}