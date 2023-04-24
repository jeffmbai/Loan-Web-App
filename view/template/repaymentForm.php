<?php
session_start();
$loggedInUser = $_SESSION['id'];

// check if values have bben submited
	if(isset($_POST['submit'])){
		//check if realy the values have bben entered
		if(isset($_POST['mPesaID'])){
			$transactionCode = $_POST['mPesaID'];
			$amountEntered = $_POST['amount'];

			
			// convert everything entered to upercase
			$newTC = strtoupper($transactionCode);

			// check if the amount entered is equal to the one owed
			// first get the amount owed from the database

			require_once('../../controller/config.php');

			$loanTobePayed = "SELECT amount, loanId FROM loans WHERE ID_number ='".$loggedInUser."' ORDER BY date DESC LIMIT 1;";


			$result = $connection->query($loanTobePayed);
			if(!$result) die($connection->error);

			$row = $result->num_rows;
			// get the returned amount
			$row = $result->fetch_array(MYSQLI_ASSOC);

			$amount = $row['amount'];
			$loanid = $row['loanId'];
			if($amountEntered == $amount){
				// insert payment to the database and notify the admin of the oayment
				$query = "INSERT INTO loanRepayments(ID_number, loanId, amountPaid, transactionCode, date) VALUES('$loggedInUser', '$loanid', '$amountEntered', '$newTC', NOW());";
				$queryResult = $connection->query($query);

				if(!$queryResult){
					
					echo "<p style='color: red; text-align: center;'>Payment could not be proccessed at this time, please try again later</p>";
				}else{
					header("location: ../../index.php");
				}
			}/*else{
				echo "<p style='color: red; text-align: center;'>Please enter an exact amount</p>";
			}*/
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>REPAY LOAN</title>
	<meta name="viewport" content="width = device-width, initial-scale = 1.0">
	<link rel="stylesheet" type="text/css" href="../css/layout.css">
</head>
<body>
	<div id="loan-repayment-form">
		<a href="../../index.php">cancel</a><br><br>
		<form name="loanRepayment" method="post" action="repaymentForm.php">
			<input type="text" name="mPesaID" placeholder="m~pesa transaction code" required class="mPesaID"><br><br>
			<input type="number" name="amount" min="100" step="1" placeholder="amount" required class="mPesaID"><br><br>
			<input type="submit" name="submit" value="REPAY" id="repay-btn">
		</form>
	</div>
</body>
</html>