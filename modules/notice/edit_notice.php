<?php
    if(isset($_SESSION['logged'])!="true")
    {
        header("Location: login.php");
        die();
    }
    if(isset($_GET['edit_notice'])){
        $notice_id = mysqli_real_escape_string($conn, $_GET['edit_notice']);
        $get_notice = "Select * from notice_period where id = '$notice_id'";
        $result_notice = mysqli_query($conn,$get_notice);
        $row_notice = mysqli_fetch_array($result_notice);
    }
?>
<h1>Edit Notice Period</h1>
<div class="form-container">
    <form method="post" action="" enctype="multipart/form-data" id="form">
        <fieldset>
            <legend>Notice Details</legend>
                <ul class="form-flex-outer">
                	<li>
                        <label for="contract-num">Contract No.</label>
                        <input type="text" id="contract-num" name="contract-num" value="<?php echo $row_notice['contract_no']; ?>" required="required">
                    </li>
                    <li>
                        <label for="datepicker">Notice Date</label>
                        <input type="text" name="notice_date" id="datepicker" value="<?php 
                            $dateArray = explode('-', $row_notice['date']);
                            $date = $dateArray[1].'/'.$dateArray[2].'/'.$dateArray[0];
                            echo $date; 
                        ?>" required="required">
                    </li>
                    <li>
                        <label for="notice_description">Notice Description</label>
                        <textarea rows="6" name="notice_description" id="notice_description"><?php echo $row_notice['description']; ?></textarea>
                    </li>
                    <li>
                    	<input type="submit" name="add_notice">
                    </li>
                </ul>
        </fieldset>
    </form>
</div>

<?php
	if(isset($_POST['add_notice'])){
	    $contract_num = mysqli_real_escape_string($conn, $_POST['contract-num']);
	    $noticeDateArray = explode('/', $_POST['notice_date']);
	    $notice_date = $noticeDateArray[2].'-'.$noticeDateArray[0].'-'.$noticeDateArray[1];
	    $notice_description = mysqli_real_escape_string($conn,$_POST['notice_description']);

	    $update_notice = "Update notice_period set contract_no='$contract_num', date='$notice_date', description = '$notice_description' where id = '$notice_id'";
	    $result_notice = mysqli_query($conn, $update_notice);
	    if($result_notice){
	    	echo"<script>alert('Notice updated successfully!')</script>"; 
	        echo"<script>window.open('index.php?view_all_notices','_self')</script>";
	    }
	}
?>