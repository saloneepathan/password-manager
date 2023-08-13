<?php 

	include("Controllers/db_controller.php");

?>

<?php 
	if(isset($_POST["submit"])){
		if(preg_match("/@/", $_POST["email"]) == false){
			$form_err = "Invalid E-Mail";
		}
		elseif($_POST["pass"] != $_POST["cpass"]){
			$form_err = "Both Passwords should match! Please re-enter.";
		}
		else{
			$hashed_password = password_hash($_POST["pass"], PASSWORD_BCRYPT);
			$success = register($_POST["email"], $hashed_password);
		}
	}
?>