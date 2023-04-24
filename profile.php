<?php
session_start();
$userID = $_SESSION['id'];
$title = "profile";
require_once('view/template/header.html');

?><link rel="stylesheet" type="text/css" href="view/css/layout.css">
	<div id="profile">
		<div id="profile-info">
			<div id="img">
				<img src="view/images/user.png" width="40" height="40">
			</div>
			<?php
			require_once('controller/config.php');

			$query = "SELECT * FROM users WHERE ID_number = '".$userID."';";

			$result = $connection->query($query);
			if(!$result) die($connection->error);
			// number of returned rows
			$row = $result->num_rows;
			// get the individual vlues of the result
				$row = $result->fetch_array(MYSQLI_ASSOC);

				echo "	<div id='credential-table'>
							<table>
								<th>Your Profile</th>
								<tr>
									<td>First Name:</td>
									<td>".$row['first_name']."</td>
								</tr>
								<tr>
									<td>Surname:</td>
									<td>".$row['surname']."</td>
								</tr>
								<tr>
									<td>Phone:</td>
									<td>".$row['phone']."</td>
								</tr>
								<tr>
									<td>ID number:</td>
									<td>".$row['ID_number']."</td>
								</tr>
							</table>
						</div>";
			?>
		</div>
	</div>
<?php 
	require_once('view/template/footer.html'); 
?>