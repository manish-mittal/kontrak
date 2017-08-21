<?php
    if(isset($_SESSION['logged'])!="true")
    {
        header("Location: login.php");
        die();
    }
?>
<div id="page-wrap">
	<h1>All Invoices</h1>
	<table>
		<thead>
			<tr>
				<th>S No.</th>
				<th>Invoice No.</th>
				<th>Contract No.</th>
				<th>Description</th>
				<th>Amount</th>
				<th>Date</th>
				<th>Edit</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$contract_num = mysqli_real_escape_string($conn,$_GET['reference-num']);
				$get_invoices = "Select * from invoice where contract_no = '$contract_num'";
				$result_invoices = mysqli_query($conn,$get_invoices);
				$i = 0;
				if(mysqli_num_rows($result_invoices) == 0){
					echo "<td>No Invoices found.</td>";
				}
				else{
					while($row_invoices = mysqli_fetch_array($result_invoices)){
						$invoice_num = $row_invoices['id'];
						$description = $row_invoices['description'];
						$amount = $row_invoices['amount'];
						$dateArray = explode('-', $row_invoices['date']);
        				$date = $dateArray[1].'/'.$dateArray[2].'/'.$dateArray[0];
						$i++;
	   		?>
   			<tr>
      			<td><?php echo $i; ?></td>
      			<td><?php echo $invoice_num; ?></td>
      			<td><?php echo $contract_num;?></td>
      			<td><?php echo $description; ?></td>
      			<td><?php echo $amount; ?></td>
      			<td><?php echo $date; ?></td>
      			<td><a href="index.php?edit_invoices=<?php echo $invoice_num; ?>">Edit</a></td>
   			</tr>
   			<?php 
   					} 
  				}
  			?>
		</tbody>
	</table>
</div>