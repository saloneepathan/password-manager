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

function decrypt($encrypted_pass , $encryption_iv):array
{

	$ciphering = "AES-128-CTR";
	$options = 0;
	$encryption_key = $_SESSION['pass'];
	$decrypted_pass=openssl_decrypt ($encrypted_pass, $ciphering, $encryption_key, $options, $encryption_iv);
	$success = array("pass"=>$decrypted_pass);
	return $success;
}

// encrypt("himanshu");
// decrypt("+6ObyyluzFAxio2/wXVqDg==", "6a5c3a633a185c2e1053b8d5ef9def76");
// echo $_SESSION['pass'];

// Store the cipher method

// Use OpenSSl Encryption method

// Non-NULL Initialization Vector for encryption

// Store the encryption key


// Use openssl_encrypt() function to encrypt the data

// Display the encrypted string
// echo "Encrypted String: " . $encryption . "\n";

// Non-NULL Initialization Vector for decryption
// $decryption_iv = $encryption_iv;

// Store the decryption key
// $decryption_key = "GeeksforGeeks";

// Use openssl_decrypt() function to decrypt the data


// Display the decrypted string
// echo "Decrypted String: " . $decryption;

?>
