<?php

	require_once("Controllers/db_controller.php");

?>

<?php

	session_start(); 
	if(!isset($_SESSION['id'])){
		header("Location: login.php");
	}

	clearallpass($_SESSION['id']);
	header("Location: dashboard.php");

?>