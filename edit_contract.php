<?php
	if(isset($_SESSION['logged'])!="true")
    {
        header("Location: login.php");
        die();
    }
?>

<h1 style="text-align: left; padding-left: 5%;">Edit Contract</h1>
<div class="form-container">
    <form method="post" action="index.php?updateContract" enctype="multipart/form-data" id="form">
        <fieldset>
            <legend>Contract Details</legend>
                <ul class="form-flex-outer">
                    <li>
                        <label for="reference-num">Reference No.</label>
                        <input type="text" id="reference-num" name="reference-num" placeholder="Enter contract reference number here">
                    </li>
                    <li>
                        <input type="submit" name="edit_contract">
                    </li>
                </ul>
        </fieldset>
    </form>
</div>