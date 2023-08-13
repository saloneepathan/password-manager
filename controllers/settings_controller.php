<?php 
	
	require_once("Controllers/db_controller.php");

?>

<?php

	session_start(); 
	if(!isset($_SESSION['id'])){
		header("Location: login.php");
	}

	if(isset($_POST['change_pass'])){
		$success = fetch($_SESSION['email']);
		if(password_verify($_POST['cpass'], $success['pass'])){
			if($_POST['npass'] == $_POST['cnpass']){
				$user_error = "";
				$hashed_password = password_hash($_POST["npass"], PASSWORD_BCRYPT);
				resetpass($_SESSION['email'], $hashed_password);
				$user_error = "Password Changed";
			}
			else{
				$user_error = "Passwords do not match";
			}
		}
		else{
			$user_error = "Incorrect Password";
		}
	}

	if(isset($_POST['del_acc'])){
		$success = fetch($_SESSION['email']);
		if(password_verify($_POST['cpass'], $success['pass'])){
			$del_error = "";
			clearallpass($_SESSION['id']);
			deletefromusers($_SESSION['email']);
			$showalert = "1";
		}
		else{
			$del_error = "Incorrect Password";
			$showalert = "";
		}
	}

?>