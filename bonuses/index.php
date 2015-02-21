<?php
    if ( !isset($_SESSION))	session_start();
		header('Content-Type: text/html;charset=UTF-8'); 
	if(isset($_GET['action']) && $_GET['action'] == "out") {
		header("Location: http://".$_SERVER['HTTP_HOST']."/");
	}	

		//ПЕРВОЕ ВЕТЛЕНИЕ 
		require_once 'model/index.php';
		require_once 'controller/index.php';
		require_once 'view/index.php'; // визуальная основа

?>


