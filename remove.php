<?php

	require_once("Controllers/db_controller.php");

?>

<?php

	session_start(); 
	if(!isset($_SESSION['email'])){
		header("Location: login.php");
	}

	if(!isset($_GET['token'])){
		echo "Invalid URL";
	}
	else{
		removepass($_GET['token']);
		header("Location: dashboard.php");
	}

	if(!isset($_GET['cardtoken'])){
		echo "Invalid URL";
	}
	else{
		removecard($_GET['cardtoken']);
		header("Location: cards.php");
	}

?>