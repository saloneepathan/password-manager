<?php

	include("Controllers/db_controller.php");

?>

<?php 
	if(isset($_POST["check"])){
		$success = fetch($_POST["username"]);
		if($success == false){
			$user_err = "2";
		}
		elseif(password_verify($_POST["pass"], $success['pass'])){
			session_start();
			$_SESSION['id'] = $success['id']; 
			$_SESSION['pass'] = $_POST['pass'];
			$_SESSION['email'] = $_POST['username'];
			session_commit();     
			header("Location: dashboard.php");			
		}
		else{
			$user_err = "1"; 
		}
	}

?>