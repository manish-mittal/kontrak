<div id="page-wrap">
	<h1>All Categories</h1>
	<div>
		<form method="post" action="" enctype="multipart/form-data" id="form">
			<input type="text" name="category" placeholder="New Contract Category" style="margin-bottom: 10px; padding: 5px;">
			<button type="submit" name="new_category" style="margin-bottom: 15px; padding: 5px;">Add New Category</button>
		</form>
	</div>
	<?php
		if(isset($_POST['new_category'])){
			$category = mysqli_real_escape_string($conn,$_POST['category']);
			$add_category = "Insert into category (category) values('$category')";
			$result_category = mysqli_query($conn, $add_category);
			if($result_category){
				echo "<script>alert('New Category Added');</script>";
				echo"<script>window.open('index.php?categories','_self')</script>";
			}
			else{
				echo "<script>alert('Some Error Occurred');</script>";
			}
		}
	?>
	<table>
		<thead>
			<tr>
				<th>S No.</th>
				<th>Category Id</th>
				<th>Category</th>
				<th>Edit</th>
				<th>Remove</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$get_category = "select * from category";
				$result_category = mysqli_query($conn,$get_category);
				$i = 0;
				if(mysqli_num_rows($result_category) == 0){
					echo "<td>No Notice Periods found.</td>";
				}
				else{
					while($row_category = mysqli_fetch_array($result_category)){
						$category_id = $row_category['category_id'];
						$category = $row_category['category'];
						$i++;
	   		?>
   			<tr>
      			<td><?php echo $i; ?></td>
      			<td><?php echo $category_id; ?></td>
      			<td><?php echo $category;?></td>
      			<td><a href="index.php?edit_category=<?php echo $category_id;?>">Edit</a></td>
      			<td><a href="index.php?delete_category=<?php echo $category_id; ?>">Delete</a></td>
   			</tr>
   		<?php 
   				} 
  			}
  		?>
		</tbody>
	</table>
</div>