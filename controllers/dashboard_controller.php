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
		$success = addpass($_POST['website'], $_POST['username'], $_POST['password'], $id);
		if($success == "1"){
			$user_err = "";
		}
		elseif($success == "-1"){
			$user_err = "Not inserted" ;
		}
	}

	if(isset($_GET['generate'])){
		$limit = $_GET['length'];
		if(isset($_GET['symbol'])){
			$symbol = TRUE;
		}
		else{
			$symbol = FALSE;
		}

		if (isset($_GET['number'])) {
			$number = TRUE;
		}
		else {
			$number = FALSE;
		}
		$generatedPassword = generatePassword($limit, $symbol, $number);
	}

?>