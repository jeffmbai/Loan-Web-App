<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo "$name";  ?></title>
	<meta name="viewport" content="width = device-width, initial scale = 1.0">
	<link rel="stylesheet" type="text/css" href="view/css/style.css">
</head>
<body>
	<div id="profile">
		<div id="header">
			<div id="img">
				<img src="images/user.png" width="40" height="40">
			</div>
			<a href="landing.html" id="back">Back</a>
		</div>
		<hr>
		<div id="profile-info">
			<?php
				// codes to retrieve content from the database
				echo "hello here is your profile";
			?>
		</div>
	</div>

</body>
</html>