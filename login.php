<?php

	require_once('controller/config.php');

	if(isset($_POST['submit'])){
		$idNumber = $_POST['id'];
		$password = $_POST['pwd'];
		//check if empty
		if(empty($idNumber) || empty($password)){
			$message = "please enter your login credentials";
		}else{
			//check if id number entered is numeric
			if(is_numeric($idNumber)){
				//check its length
				$idLength = strlen($idNumber);
				if($idLength < 7 || $idLength > 8){
					echo "Your ID numbershould be 7 or 8 digits";
				}
			}else{
				echo "ID number must be a number";
			}

			//if this conditions are met query the database to see if the user is registered
			$user ="SELECT ID_number, password FROM users WHERE ID_number = '".$idNumber."' AND password = '".$password ."';";
			$result = $connection->query($user);


			//look for the rows returned by the query
			$rows = $result->num_rows;
			if($rows == 1){
              session_start();
				//sign in the user - set session variables
				$_SESSION['id'] = $idNumber;
              		header("location: index.php");

			}else{
				echo "incorect login details. please check and try again";
			}

		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SIGN IN</title>
	<meta name="viewport" content="width = device-width, initial-scale = 1.0">
	<link rel="stylesheet" type="text/css" href="view/css/style.css">
</head>
<body class="B">
	<div class="main">
		<div id="login-form">
			<!-- sign in form -->
			<form name="login" action="login.php" method="post">
				<input type="text" name="id" placeholder="Id number..." required class="login"><br><br>
				<input type="password" name="pwd" placeholder="Password..." required class="login"><br><br>
				<input type="submit" name="submit" value="SIGNIN" class="frm-btn">
			</form>
			<div id="pwd-reset">
				<a href="pwd_reset.php">Forgot password?</a>
			</div>
		</div>
	</div>

</body>
</html>