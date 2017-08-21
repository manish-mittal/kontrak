<?php
	if(isset($_SESSION['logged'])!="true")
    {
        header("Location: login.php");
        die();
    }
?>

<h1>Generate Report</h1>
<div class="form-container">
    <form method="get" action="modules/invoice/invoice_report.php" enctype="multipart/form-data" id="form">
        <fieldset>
                <ul class="form-flex-outer">
                    <li>
                        <label for="reference-num">Reference No.</label>
                        <input type="text" id="reference-num" name="reference-num" placeholder="Enter contract reference number here" required="required">
                    </li>
                    <li>
                        <input type="submit" name="invoice_report" value="Generate">
                    </li>
                </ul>
        </fieldset>
    </form>
</div>