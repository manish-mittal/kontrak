<?php
	if(isset($_SESSION['logged'])!="true")
	{
 		header("Location: login.php");
 		die();
	}

   if(isset($_GET['delete_notice'])){
        $delete_id = mysqli_real_escape_string($conn, $_GET['delete_notice']);
        $delete_notice = "Delete from notice_period where id = '$delete_id'";
        $result_delete = mysqli_query($conn, $delete_notice);
   
        if($result_delete){
		   echo"<script>alert('Notice Removed!')</script>";
		   echo"<script>window.open('index.php?view_all_notices','_self')</script>";
        }
    }
    mysqli_close($conn);
?>