<?php
	if(isset($_SESSION['logged'])!="true")
    {
        header("Location: login.php");
        die();
    }
?>

<h1>Invoice Management</h1>
<div class="form-container">
    <form method="get" action="index.php?view_invoices" enctype="multipart/form-data" id="form">
        <fieldset>
            <legend>Contract Details</legend>
                <ul class="form-flex-outer">
                    <li>
                        <label for="reference-num">Reference No.</label>
                        <input type="text" id="reference-num" name="reference-num" placeholder="Enter contract reference number here" required="required">
                    </li>
                    <li>
                        <input type="submit" name="view_invoices" value="View All Invoices">
                    </li>
                </ul>
        </fieldset>
    </form>
</div>