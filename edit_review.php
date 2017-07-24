<?php
    if(isset($_SESSION['logged'])!="true")
    {
        header("Location: login.php");
        die();
    }
    if(isset($_GET['edit_review'])){
        $review_id = $_GET['edit_review'];
        $get_review = "Select * from review where id = '$review_id'";
        $result_review = mysqli_query($conn,$get_review);
        $row_review = mysqli_fetch_array($result_review);
    }
?>
<h1 style="text-align: left; padding-left: 5%;">Edit Review</h1>
<div class="form-container">
    <form method="post" action="" enctype="multipart/form-data" id="form">
        <fieldset>
            <legend>Review Details</legend>
                <ul class="form-flex-outer">
                	<li>
                        <label for="contract-num">Contract No.</label>
                        <input type="text" id="contract-num" name="contract-num" value="<?php echo $row_review['contract_no']; ?>">
                    </li>
                    <li>
                        <label for="reviewer">Reviewer</label>
                        <input type="text" id="reviewer" name="reviewer" value="<?php echo $row_review['reviewer_name']; ?>">
                    </li>
                    <li>
                        <label for="datepicker">Review Date</label>
                        <input type="text" name="review_date" id="datepicker" value="<?php 
                            $dateArray = explode('-', $row_review['date']);
                            $date = $dateArray[1].'/'.$dateArray[2].'/'.$dateArray[0];
                            echo $date; 
                        ?>">
                    </li>
                    <li>
                        <label for="comments">Comments</label>
                        <textarea rows="6" name="comments" id="comments"><?php echo $row_review['reviewer_comments']; ?></textarea>
                    </li>
                    <li>
                    	<input type="submit" name="update_review">
                    </li>
                </ul>
        </fieldset>
    </form>
</div>

<?php
	if(isset($_POST['update_review'])){
	    $contract_num = mysqli_real_escape_string($conn, $_POST['contract-num']);
        $reviewer = mysqli_real_escape_string($conn, $_POST['reviewer']);
	    $reviewDateArray = explode('/', $_POST['review_date']);
	    $review_date = $reviewDateArray[2].'-'.$reviewDateArray[0].'-'.$reviewDateArray[1];
	    $comments = mysqli_real_escape_string($conn,$_POST['comments']);

	    $update_review = "Update review set contract_no = '$contract_num', reviewer_name = '$reviewer', date = '$review_date', reviewer_comments = '$comments' where id = '$review_id'";
	    $result_review = mysqli_query($conn, $update_review);
	    if($result_review){
	    	echo"<script>alert('Review updated successfully!')</script>"; 
	        echo"<script>window.open('index.php?view_all_reviews','_self')</script>";
	    }
	}
?>