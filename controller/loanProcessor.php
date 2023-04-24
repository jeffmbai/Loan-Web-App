<?php
session_start();

$userid = $_SESSION['id'];
require_once('config.php');


if(isset($_POST['amount'])){

  //take the vairables posted
  $loanAmount = $_POST['amount'];

  // function to calculate the total loan
    //added to interest
  function totalLoanAmount($principle, $rate, $time){
    $interest = ($principle*$rate*$time)/100;

    return $interest;
  }

  $total = (totalLoanAmount($loanAmount, 10, 1))+$loanAmount;

  // geberate the loan id
    function loanID($length){
      $numbers = range(0,16);
      shuffle($numbers);
      for($i = 0; $i<$length; $i++){
        $digits .=$numbers[$i];
      }
      return $digits;
    }

   //call to tye function and assign it to a variable
   $lID = loanID(10);
  echo "total amount is: ".$total."loan id is : " .$lID."and your id number is: ". $userid;

  if($total > 100){
	require('../model/query.handler.php');
    applyLoan($lID, $userid, $total, 'NOW()');
    header("location: ../index.php");
  }
}else{
  $notice = "amount must be more than KES: 100";
}


?>