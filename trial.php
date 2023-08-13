<?php
function encrypt($password):array
{

	$ciphering = "AES-128-CTR";
	$iv_length = openssl_cipher_iv_length($ciphering);
	$options = 0;
	$iv = openssl_random_pseudo_bytes($iv_length);
	$encryption_iv = bin2hex($iv);
	$encryption_key = $_SESSION['pass'];
	$encrypted_pass = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);
	$success = array("pass"=>$encrypted_pass, "iv"=>$encryption_iv);
	return $success;
}

$success = encrypt(456456456544);

?>