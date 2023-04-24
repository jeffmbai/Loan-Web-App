<?php
	$hostName = 'localhost';
	$database = 'loanApp';
	$username = 'root';
	$password = '';

	$connection = new mysqli($hostName, $username, $password, $database);
	if($connection->connect_error) die($connection->connect_error);
?>