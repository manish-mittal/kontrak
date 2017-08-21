<?php
    if(isset($_SESSION['logged'])!="true")
    {
        header("Location: login.php");
        die();
    }
    if(isset($_GET['edit_category'])){
        $category_id = mysqli_real_escape_string($conn, $_GET['edit_category']);
        $get_category = "Select * from category where category_id = '$category_id'";
        $result_category = mysqli_query($conn,$get_category);
        $row_category = mysqli_fetch_array($result_category);
    }
?>
<h1>Edit Category</h1>
<div class="form-container">
    <form method="post" action="" enctype="multipart/form-data" id="form">
        <fieldset>
            <legend>Category Details</legend>
                <ul class="form-flex-outer">
                	<li>
                        <label for="category">Category</label>
                        <input type="text" id="category" name="category" value="<?php echo $row_category['category']; ?>" required="required">
                    </li>
                    <li>
                    	<input type="submit" name="update_category">
                    </li>
                </ul>
        </fieldset>
    </form>
</div>

<?php
	if(isset($_POST['update_category'])){
	    $category = mysqli_real_escape_string($conn, $_POST['category']);
	    $update_category = "Update category set category='$category' where category_id = '$category_id'";
	    $result_category = mysqli_query($conn, $update_category);
	    if($result_category){
	    	echo"<script>alert('Category updated successfully!')</script>"; 
	        echo"<script>window.open('index.php?categories','_self')</script>";
	    }
	}
?>