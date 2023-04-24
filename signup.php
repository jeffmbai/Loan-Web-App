<?php
// require database connection
require_once('controller/config.php');
 	// check if the submit button was clicked 
 	if(isset($_POST['submit'])){
 		$firstName = $_POST['f_name'];
 		$surname   = $_POST['s_name'];
 		$phone     = $_POST['phone'];
 		$id_number = $_POST['id'];
 		$password  = $_POST['pwd'];
 		$confirmPassword = $_POST['cpwd'];

 		//check if all fields have values
 		$er = false;
 		if(empty($firstName) || empty($surname) || empty($phone) || empty($id_number) || empty($password) || empty($confirmPassword)){
 			$error[0] = "please fill in all details";
 			print $error[0];
 			$er = true;
 		}else{
 			// validate phone id number and password
 			$phoneLength = strlen($phone);
 			if($phoneLength != 10){
 				$error[0] = "your phone number must be 10 digits";
 				print $error[0];
 				$er = true;
 			}
 			if($password != $confirmPassword){
 				$error[0] = "the passwords you entered are not matchin";
 				print $error[0];
 				$er =true;
 			}else{
	 			$password_len = strlen($password);
	 			if($password_len < 8){
	 				$error[0] =  "password must me more than 8 characters";
	 				print $error[0];
	 				$er = true;
	 			}
	 		}
	 		// if no error is encountered, proceed to sign in the user
	 		if($er == false){
	 			// check if a user with the same id number alreadey exists
	 			$user = "SELECT ID_number FROM users WHERE ID_number = '".$id_number."';";
	 			$result = $connection->query($user);
	 			if(!$result) die($connection->error);

	 			// check the number if rows returned by the query
	 			$rows = $result->num_rows;
	 			if($rows == 1){
	 				$error[0] = "User with the same ID number already exists in our database";
	 				print $error[0];
	 			}else{
		 			$registerUser = "INSERT INTO users(first_name, surname, phone, ID_number, password)
		 							 VALUES('$firstName','$surname','$phone','$id_number','$password')";

		 			$result = $connection->query($registerUser);
		 			if(!$result){
		 				echo "Registration failed, try again later";
		 			}else{
		 				header("location: login.php");
		 			}
		 		}
	 		}
 		}
 	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>SIGN UP</title>
	<meta name="viewport" content="width = device-width, initial-scale = 1.0">
	<link rel="stylesheet" type="text/css" href="view/css/style.css">
</head>
<body class="B">
	<div class="main">

	<div class="signup-form">
		<div id="sign-up-form-area">
			<form name="signup" action="signup.php" method="post">
				<input type="text" name="f_name" placeholder="First name ..." required class="login"><br><br>
				<input type="text" name="s_name" placeholder="Surname..." required class="login"><br><br>
				<input type="text" name="phone" placeholder="Phone number..." required class="login"><br><br>
				<input type="text" name="id" placeholder="ID Number..." required class="login"><br><br>
				<input type="password" name="pwd" placeholder="Password..." required class="login"><br><br>
				<input type="password" name="cpwd" placeholder="Confirm password" required class="login"><br><br>
				<input type="submit" name="submit" value="SIGN UP" class="frm-btn">
			</form>
		</div>
	</div>
	</div>

</body>
</html>