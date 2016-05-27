<?php

require_once('./Core/Router.php');

$params     =  explode('/', $_GET['url']);
$controller =  ucfirst(strtolower(@$params[0]));
$action     =  strtolower(@$params[1]);

if (empty($controller))
{ 
	$controller = 'Reservation';
}

if (empty($action))
{
	$action = 'index';
}

define('controller', $controller);
define('action', $action);

$controller .= 'Controller';

$path_controller = CTRL.$controller.'.php';
if(file_exists($path_controller))
{
	require_once($path_controller);
	$controller = new $controller();
	unset($params[0]);
	unset($params[1]);
	$controller->start($action, $params);
} else
{
	$path_controller = CORE.'Controller.php';
	require_once($path_controller);
	$controller = new Controller();
	$controller->setViews('error');
	$controller->setLayout('home');
	$controller->render('404');
}

?>