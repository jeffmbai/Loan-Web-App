<?php
session_start();
$userID = $_SESSION['id'];
$title = "Loan statement";
require_once('view/template/header.html');
?>
<meta charset="utf-8">
<meta name="viewport" content="width= device-width, initial-scale = 1.0">
<link rel="stylesheet" type="text/css" href="view/css/layout.css">
	<div id="loan-statement">


		<div id="loan-info">

			<?php
			require_once('controller/config.php');

			$query = "SELECT * FROM loans WHERE ID_number = '".$userID."' ORDER BY date DESC;";
			$loanRepayments = "SELECT * FROM loanRepayments WHERE ID_number = '".$userID."' ORDER BY date DESC;";

			$repaymentResult = $connection->query($loanRepayments);
			if(!$repaymentResult) die($connection->error);

			$result = $connection->query($query);
			if(!$result) die($connection->error);
			// number of returned rows
			$repaymentRow = $repaymentResult->num_rows;
			$row = $result->num_rows;


			// get the individual vlues of the result
				echo "BORROWINGS:<br>";
				for($i = 0; $i < $row; $i++){
				$result->data_seek($i);
				$row = $result->fetch_array(MYSQLI_ASSOC);

				print "	<div id='credential-table'>
							<table>
								<tr>
									<td>".$row['date']."</td>
									<td>".$row['amount']."</td>
									<td>".$row['loanId']."</td>
								</tr>
							</table>
						</div>";
				}
				echo "<br>REPAYMENT DETAILS<br>";
				for($j = 0; $j <$repaymentRow; $j++){

				$repaymentResult->data_seek($j);
				$repaymentRow = $repaymentResult->fetch_array(MYSQLI_ASSOC);

				print "	<div id='credential-table'>
							<table>
								<tr>
									<td>".$repaymentRow['date']."</td>
									<td>".$repaymentRow['transactionCode']."</td>
								</tr>
								<tr>
									<td>".$repaymentRow['loanId']."</td>
									<td>".$repaymentRow['amountPaid']."</td>
								</tr>
							</table>
						</div>";
				}
			?>
		</div>
	</div>
<?php 
	require_once('view/template/footer.html'); 
?>