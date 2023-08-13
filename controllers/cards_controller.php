<?php

	require_once("Controllers/db_controller.php");

?>

<?php

	session_start(); 
	if(!isset($_SESSION['id'])){
		header("Location: login.php");
	}

	if(isset($_POST['add'])){
		$id = (int)$_SESSION['id'];
		$success = addcard($_POST['name'], $_POST['holder'], $_POST['number'], $_POST['expiry'], $_POST['cvv'], $_POST['brand'], $id);
		if($success == "1"){
			$user_err = "";
		}
		elseif($success == "-1"){
			$user_err = "Not inserted" ;
		}
	}
	if(isset($_GET['generate'])){
		$limit = $_GET['length'];
		$generatedPassword = generatePassword($limit);

	}

?>