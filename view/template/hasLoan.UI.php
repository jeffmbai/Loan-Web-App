<?php
$loggedInId = $_SESSION['id'];
?>
<link rel="stylesheet" type="text/css" href="../css/layout.css">
<main style="width: 320px;
              margin: 1px auto;">
<div id = "pending-loan-details"
     style="width: 200px;
            height: 350px;
            margin: 30px auto;
            padding:20px;
            border: solid 1px red;
            border-radius: 20px;">
	<?php
		require('controller/config.php');

  		//query the database and get the pending loan
  		$query = "SELECT loanId, amount FROM loans WHERE ID_number ='".$loggedInId."' ORDER BY date DESC LIMIT 1;";

  		$result = $connection->query($query);
  		if(!$result) die($connection->error);

  		//get the returned rows
  		$row = $result->num_rows;
          $row = $result->fetch_array(MYSQLI_ASSOC);

          //output the rows returnes in a table
          echo "
          <meta name='viewport' content='width = device-width, initial-scale = 1.0'>
          <div id= 'loanInfo'>
          		<p> Your loan was processed successfully and sent to m~pesa.<br><br>You now have a pending loan due in one month. please pay your loan early to increase your loan limit</p>
          			<table>
                    	<tr>
                        	<td>
                            	<p>Amount:</p>
                            </td>
                            <td>
                            	".$row['amount']."
                            </td>
                        </tr>
                        <tr>
                        	<td>
                            	<p>Loan ID: </p>
                            </td>
                            <td>
                            	".$row['loanId']."
                            </td>
                        </tr>
                    </table>
          		</div>";
  	?>
  <a href="view/template/repaymentForm.php">REPAY LOAN</a>
</div>
</main>