<?php

use Base\Route;

include '../vendor/autoload.php';

$route = new Route();
/**
 * @uses \App\Controller\User::loginAction()
 */
$route->addRoute('user/login', \App\Controller\User::class, 'login');
/**
 * @uses \App\Controller\User::registerAction()
 */
$route->addRoute('user/register', \App\Controller\User::class, 'register');
/**
 * @uses \App\Controller\Blog::indexAction()
 */
$route->addRoute('blog', \App\Controller\Blog::class, 'index');
$route->addRoute('blog/index', \App\Controller\Blog::class, 'index');

$controllerName = $route->getControllerName();
$controller = new $controllerName;

$actionName = $route->getActionName();
$controller->$actionName();