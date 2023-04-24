<?php
//this file should register all user requests and communicate to tye database and output the correct view to the user.

//dunction to hanndle queries
$userid= $_SESSION['id'];
function queries($userid){
  	// get the account details of this user
	if($userid){
      require('./model/query.handler.php');
      //call to tye db function
      $loanPending = userLoan($userid);

      $title = "Home";
     if($loanPending == false){
        // call tye header footer and the body with loan request butyon.
        require('./view/template/header.html');
        require('./view/template/noLoan.UI.html');
        require('./view/template/footer.html');
      }else{
        require('./view/template/header.html');
       	require('./view/template/hasLoan.UI.php');
        require('./view/template/footer.html');
      }
      //loanStatement($userid);
    }
}