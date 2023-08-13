<?php

	include("Controllers/encrypt.php");

?>
 <?php

 	function createConn(){
 		$servername = "localhost";
		$username = "admin";
		$password = "adminpassword";
		$dbname = "pmanager";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
    		die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
 	}

?>

<?php 

	function register($email, $pass){
		$conn = createConn();
		// $sql = "INSERT INTO users (email, pass) VALUES('$email', '$pass');";
		$sql = $conn->prepare("INSERT INTO users (email, pass) VALUES(?, ?);");
		$sql->bind_param("ss", $email, $pass);
		if ($sql->execute()) {
    		$success = "1";
		} 
		else {
    		$success = "2";
		}
		return $success;
	}

	function fetch($email){
		$conn = createConn();
		$sql = "SELECT * FROM users WHERE email = '".$email."';";
		$result = $conn -> query($sql);
		if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
        		$success = array("id"=> $row['id'], "pass"=> $row['pass'], "flag"=> true);
				// $success = $row['pass'];
        		return $success;
    		}
		} 
		else {
    		$success = false;
    		return $success;
		}
	}

	function resetpass($email, $pass){
		$conn = createConn();
		$sql = "UPDATE users SET pass = '$pass' WHERE email = '$email';";
		if ($conn->query($sql) == TRUE) {
    		$success = "1";
		} 
		else {
    		$success = "2";
		}
		return $success;
	}

	function fetchtoken($email){
		$conn = createConn();
		$sql = "SELECT token FROM users WHERE email = '".$email."';";
		$result = $conn -> query($sql);
		if ($result->num_rows > 0) {
    		while($row = $result->fetch_assoc()) {
        		$success = $row["token"];
        		return $success;
    		}
		} 
		else {
    		$success = "-1";
    		return $success;
		}
	}

	function forgotpass($email, $token){
		$conn = createConn();
		$sql = "UPDATE users SET token = '".$token."' WHERE email = '".$email."';";
		if ($conn->query($sql) == TRUE) {
    		$success = "1";
		} else {
    		$success = "2";
		}
		return $success;
	}

	function addpass($name, $username, $password, $id){
		$conn = createConn();
		$success = encrypt($password);
		if($success != ""){
			$pass = $success['pass'];
			$iv = $success['iv'];
			$sql = $conn->prepare("INSERT INTO passwords(website, username, pass, id, iv) VALUES(?, ?, ?, ?, ?);");
        	$sql->bind_param("sssis", $name, $username, $pass, $id, $iv);
			if($sql->execute() == TRUE){
				return "1";
			}
			else{
				// $success = "-1";
				return "-1";
			}
		}
	}
	function retrievepass($id){
		$conn = createConn();
		$sql = "SELECT * FROM passwords WHERE id = '".$id."';";
		$result = $conn -> query($sql);
		if($result->num_rows > 0){
			$GLOBALS['nopass'] = "";
			$count = 1;
			while($row = $result -> fetch_assoc()){
				$success = decrypt($row['pass'], $row['iv']);
				echo "<tr>
						<td id='wname'>{$row["website"]}</td>
						<td id='username'>{$row['username']}</td>
						<td style='text-align: center;'>
							<input style='text-align: center;' type='password' class='passfield' name='password' value={$success['pass']} disabled />
						</td>
						<td style='text-align: center;'>
							<button type='button' class='showbtn' id='{$count}'>Show</button>
						</td>
						<td style='text-align: center;'>
							<button type='button' class='removebtn' id='{$row['token']}'>Remove</button>
						</td>
					</tr>";
					$count = $count + 1;
			}
		}
		else{
			$GLOBALS['nopass'] = "You have not saved any passwords";
		}
	}

	function clearallpass($id){
		$conn = createConn();
		$sql = "DELETE FROM passwords WHERE id = $id;";
		$conn -> query($sql);
	}

	function removepass($token){
		$conn = createConn();
		$sql = "DELETE FROM passwords WHERE token = '$token' ;";
		$conn -> query($sql);
	}

	function deletefromusers($email){
		$conn = createConn();
		$sql = "DELETE FROM users WHERE email = '".$email."';";
		if($conn -> query($sql) == TRUE){
			return "1";
		}
		else {
			return "0";
		}
	}


	// Cards
	function addcard($cardname, $holdername, $cardnumber, $expiry, $cvv, $brand, $id){
		$conn = createConn();
		$enumber = encrypt($cardnumber);
		$ecvv = encrypt($cvv);
		if($enumber != ""){
			$num = $enumber['pass'];
			$numiv = $enumber['iv'];
			$cvv = $ecvv['pass'];
			$cvviv = $ecvv['iv'];
			$sql = $conn->prepare("INSERT INTO cards(cardname, holder, cardnumber, numberiv, expiry, cvv, cvviv, brand, id ) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?);");
        	$sql->bind_param("ssssssssi", $cardname, $holdername, $num, $numiv, $expiry, $cvv, $cvviv, $brand, $id);
			if($sql->execute() == TRUE){
				return "1";
			}
			else{
				// $success = "-1";
				return "-1";
			}
		}
	}

	function retrievecard($id){
		$conn = createConn();
		$sql = "SELECT * FROM cards WHERE id = '".$id."';";
		$result = $conn -> query($sql);
		if($result->num_rows > 0){
			$GLOBALS['nopass'] = "";
			$count = 1;
			while($row = $result -> fetch_assoc()){
				$dnumber = decrypt($row['cardnumber'], $row['numberiv']);
				$dcvv = decrypt($row['cvv'], $row['cvviv']);
				echo "<tr>
						<td id='cname'>{$row["cardname"]}</td>
						<td id='holder'>{$row['holder']}</td>
						<td style='text-align: center;'>
							<input style='text-align: center;' type='password' class='passfield' name='password' value={$dnumber['pass']} disabled />
						</td>
						<td id='expiry'>{$row['expiry']}</td>

						<td style='text-align: center;'>
							<input style='text-align: center;' type='password' class='passfield' name='password' value={$dcvv['pass']} disabled />
						</td>
						<td id='brand'>{$row['brand']}</td>
						<td style='text-align: center;'>
							<button type='button' class='showbtn' id='{$count}'>Show</button>
						</td>
						<td style='text-align: center;'>
							<button type='button' class='removecard' id='{$row['token']}'>Remove</button>
						</td>
					</tr>";
					$count = $count + 1;
			}
		}
		else{
			$GLOBALS['nopass'] = "You have not saved any cards";
		}
	}

	function clearallcard($id){
		$conn = createConn();
		$sql = "DELETE FROM cards WHERE id = $id;";
		$conn -> query($sql);
	}

	function removecard($token){
		$conn = createConn();
		$sql = "DELETE FROM cards WHERE token = '$token' ;";
		$conn -> query($sql);
	}





	function generatePassword($limit, $symbol, $number){
		$lower = "abcdefghijklmnopqrstuvwxyz";
		$upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$digits = "1234567890";
		$symbols = "!@#$%^&*";
		$password = "";

		// for ($i=0; $i < $limit; $i++) { 
			while(strlen($password) != $limit){
				$choice = rand(0, 3);
				switch ($choice) {
					case 0:
						$password .= $lower[rand(0, strlen($lower)-1)];
						break;
					case 1:
						$password .= $upper[rand(0, strlen($upper)-1)];
						break;
					case 2:
						if ($number) {
							$password .= $digits[rand(0, strlen($digits)-1)];
						}
						else {
							break;
						}
					case 3:
						if ($symbol) {
							$password .= $symbols[rand(0, strlen($symbols)-1)];
						}
						else {
							break;
						}
				}
			}
		return $password;
	}

?>