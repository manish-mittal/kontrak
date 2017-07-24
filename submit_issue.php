<?php
    if(isset($_SESSION['logged'])!="true")
    {
        header("Location: login.php");
        die();
    }
?>
<h1 style="text-align: left; padding-left: 5%;">Submit an Issue</h1>
<div class="form-container">
    <form method="post" action="index.php?submit_issue" enctype="multipart/form-data" id="form">
        <fieldset>
            <legend>Submit Issue</legend>
                <ul class="form-flex-outer">
                    <li>
                        <label for="reference-num">Contract No.</label>
                        <input type="text" id="reference-num" name="reference-num" placeholder="Enter contract reference number here">
                    </li>
                    <li>
                        <label for="subject">Subject</label>
                        <input type="text" name="subject" id="subject" placeholder="Add Subject to the Issue">
                    </li>
                    <li>
                        <label for="description">Description</label>
                        <textarea rows="6" id="description" name="description" placeholder="Description of Issue"></textarea>
                    </li>
                    <li>
                        <label for="issuer">Issuer Name</label>
                        <input type="text" name="issuer" id="issuer" placeholder="Issuers Name">
                    </li>
                    <li>
                        <label for="issuer_role">Issuer Role</label>
                        <input type="text" name="issuer_role" id="issuer_role" placeholder="Issuers Role">
                    </li>
                    <li>
                        <input type="submit" name="create_issue">
                    </li>
                </ul>
        </fieldset>
    </form>
</div>
<?php

    if(isset($_POST['create_issue'])) 
    {	  
	    //Text data variables
        $reference_num = mysqli_real_escape_string($conn,$_POST['reference-num']);
        $subject = mysqli_real_escape_string($conn,$_POST['subject']);
        $description = mysqli_real_escape_string($conn,$_POST['description']);
        $issuer = mysqli_real_escape_string($conn,$_POST['issuer']);
        $issuer_role = mysqli_real_escape_string($conn,$_POST['issuer_role']);

        $insert_issue = "Insert into issues(contract_no, subject, description, issuer_name, issuer_role) values('$reference_num','$subject','$description','$issuer','$issuer_role')";
	    $result_issue = mysqli_query($conn,$insert_issue);
	  
	    if($result_issue){
            echo"<script>alert('New issue submitted!')</script>"; 
            echo"<script>window.open('index.php?submit_issue','_self')</script>";
	    } 
    }
?>