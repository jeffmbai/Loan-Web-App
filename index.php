<?php
session_start();
	//chexk if a session id is available
	if($_SESSION['id']){
      //get condiguration settings
      require_once('controller/config.php');// success
		//output the users' account
      	require('controller/process.engine.php');
      // get the name
			queries($_SESSION['id']);
    }else{
      header("location: login.php");
    }