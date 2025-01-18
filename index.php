<?php
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php';

$current_url = $_SERVER['REQUEST_URI'];


if ($current_url == '/links/' || $current_url == '/links' || $current_url == '/linkS/' ) {
    header('Location: /links/inicio/index');
    exit; 
}

function show_error(){
	$error = new ErrorController();
	$error->index();
}

if(isset($_GET['controller'])){
	$nombre_controlador = ucfirst($_GET['controller']) . 'Controller';
}else if(!isset($_GET['controller']) && (!isset($_GET['action']))){
	$nombre_controlador = action_default;
}
else{
	show_error();
	exit();
}



if(class_exists($nombre_controlador)){	
	$controlador = new $nombre_controlador();
	
	if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
		$action = $_GET['action'];
		$controlador->$action();
	}else if(!isset($_GET['action'])){
		$action_default = action_default;
		$controlador->$action_default();
	}
	else{
		show_error();
	}
}else{
	require_once 'views/home/inicio.php';
}

?>
