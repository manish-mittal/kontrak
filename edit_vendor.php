<?php
    if(isset($_SESSION['logged'])!="true")
    {
        header("Location: login.php");
        die();
    }
    if(isset($_GET['edit_vendor'])){
        $vendor_id = $_GET['edit_vendor'];
        $get_vendor = "Select * from vendor where vendor_id = '$vendor_id'";
        $result_vendor = mysqli_query($conn,$get_vendor);
        $row_vendor = mysqli_fetch_array($result_vendor);
    }
?>
<h1 style="text-align: left; padding-left: 5%;">Edit Vendor</h1>
<div class="form-container">
    <form method="post" action="" enctype="multipart/form-data" id="form">
        <fieldset>
            <legend>Vendor Details</legend>
                <ul class="form-flex-outer">
                	<li>
                        <label for="num">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo $row_vendor['contact_name']; ?>">
                    </li>
                    <li>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $row_vendor['email']; ?>">
                    </li>
                    <li>
                        <label for="phone">Phone No.</label>
                        <input type="text" id="phone" name="phone" value="<?php echo $row_vendor['phone_no']; ?>">
                    </li>
                    <li>
                    	<input type="submit" name="update_vendor">
                    </li>
                </ul>
        </fieldset>
    </form>
</div>

<?php
	if(isset($_POST['update_vendor'])){
	    $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
	    $phone_num = mysqli_real_escape_string($conn, $_POST['phone']);

	    $update_vendor = "Update vendor set contact_name = '$name', email = '$email', phone_no = '$phone_num' where vendor_id = '$vendor_id'";
	    $result_vendor = mysqli_query($conn, $update_vendor);
	    if($result_vendor){
	    	echo"<script>alert('Vendor updated successfully!')</script>"; 
	        echo"<script>window.open('index.php?view_all_vendor','_self')</script>";
	    }
	}
?>