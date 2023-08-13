<?php

	require_once("Controllers/db_controller.php");

?>

<?php

	session_start(); 
	if(!isset($_SESSION['id'])){
		header("Location: login.php");
	}

	clearallcard($_SESSION['id']);
	header("Location: cards.php");

?>