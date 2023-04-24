<?php
// thus file should perform all the database queries and return tgeir values.

// get user loan details
function userLoan($userid){
  require('./controller/config.php');

  $loanQuery = "SELECT * FROM loans WHERE ID_number = '".$userid."' ORDER BY date DESC LIMIT 1;";

  $result = $connection->query($loanQuery);
    if(!$result) die($connection->error);

    //check number of rows returned
    $row = $result->num_rows;
    if($row == 0){
      $loan = false;
    }else{
    //  check the repayments table to see if the loan has been paid
    
    //get the loan id first
      $getLoanID = "SELECT loanId FROM loans WHERE ID_number = '".$userid."'ORDER BY date DESC LIMIT 1;";
      $lid = $connection->query($getLoanID);
      if(!$lid) die($connection->error);
      //pick the result
      $row = $lid->num_rows;
      for($i = 0; $i < $row; $i++){
        $lid->data_seek($i);
        $row = $lid->fetch_array(MYSQLI_ASSOC);

         $loanid = $row['loanId'];
         
        $repaymentQuery = "SELECT loanId FROM loanRepayments WHERE loanId = '".$loanid."'";

        $repaymentResult = $connection->query($repaymentQuery);

        if(!$repaymentResult) die($connection->error);

        //check the number of rows returned
        $row = $repaymentResult->num_rows;
        if($row == 0){
          $loan = true;
        }else{
          $loan = false;
        }
      }

    }
  return $loan;
}


// function to help user get a loan
function applyLoan($LoanID, $userid, $amount){
  require('../controller/config.php');

	$getLoan = "INSERT INTO loans(loanId, ID_number, amount, date)
    VALUES('$LoanID','$userid','$amount',NOW());";

  	$result = $connection->query($getLoan);
	if(!$result){
      $loanProcessed = false;
    }else{
      $loanProcessed = true;
    }
  return $loanProcessed;
}