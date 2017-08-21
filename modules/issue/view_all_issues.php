<?php
    if(isset($_SESSION['logged'])!="true")
    {
        header("Location: login.php");
        die();
    }
?>
<div id="page-wrap">
	<h1>All Issues</h1>
	<table>
		<thead>
			<tr>
				<th>S No.</th>
				<th>Issue Id</th>
				<th>Contract No.</th>
				<th>Subject</th>
				<th>Description</th>
				<th>Name</th>
				<th>Role</th>
				<th>Status</th>
				<th>Settle</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$get_issues = "select * from issues";
				$result_issues = mysqli_query($conn,$get_issues);
				$i = 0;
				if(mysqli_num_rows($result_issues) == 0){
					echo "<td>No Issues found.</td>";
				}
				else{
					while($row_issues = mysqli_fetch_array($result_issues)){
						$id = $row_issues['id'];
						$contract_num = $row_issues['contract_no'];
						$subject = $row_issues['subject'];
						$description = $row_issues['description'];
						$issuer_name = $row_issues['issuer_name'];
						$issuer_role = $row_issues['issuer_role'];
						$issue_status = $row_issues['status'];
						$i++;
	   		?>
   			<tr>
      			<td><?php echo $i; ?></td>
      			<td><?php echo $id; ?></td>
      			<td><?php echo $contract_num;?></td>
      			<td><?php echo $subject; ?></td>
      			<td><?php echo $description; ?></td>
      			<td><?php echo $issuer_name; ?></td>
      			<td><?php echo $issuer_role; ?></td>
      			<td><?php echo $issue_status; ?></td>
      			<td><a href="index.php?settle_issue=<?php echo $id; ?>">Settle</a></td>
   			</tr>
   		<?php 
   				} 
  			}
  		?>
		</tbody>
	</table>
</div>