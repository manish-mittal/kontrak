<?php
	if(isset($_SESSION['logged'])!="true")
	{
 		header("Location: login.php");
 		die();
	}

   if(isset($_GET['delete_category'])){
        $delete_id = mysqli_real_escape_string($conn, $_GET['delete_category']);
        $delete_category = "Delete from category where category_id = '$delete_id'";
        $result_delete = mysqli_query($conn, $delete_category);
   
        if($result_delete){
		   echo"<script>alert('Category Removed!')</script>";
		   echo"<script>window.open('index.php?categories','_self')</script>";
        }
    }
    mysqli_close($conn);
?>