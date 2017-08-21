<?php
    if(isset($_SESSION['logged'])!="true")
    {
        header("Location: login.php");
        die();
    }
?>
<h1>Attach An Invoice </h1>
<div class="form-container">
    <form method="post" action="index.php?attach_invoice" enctype="multipart/form-data" id="form">
        <fieldset>
            <legend>Invoice Details</legend>
                <ul class="form-flex-outer">
                    <li>
                        <label for="invoice-num">Invoice No.</label>
                        <input type="text" id="invoice-num" name="invoice-num" placeholder="Enter Invoice Reference Number Here" required="required">
                    </li>

                     <li>
                        <label for="invoice-num">Contract No.</label>
                        <input type="text" id="contract-num" name="contract-num" placeholder="Enter Contract Number Here" required="required">
                    </li>
                    <li>
                        <label for="description">Description</label>
                        <textarea rows="6" id="description"  name="description" placeholder="Enter Description here"></textarea>
                    </li>
                     <li>
                        <label for="invoice-file">File</label>
                        <input id="file" name="file" type="file" attach="pdf" required="required"></input>

                    </li>
                    <li>
                        <label for="amount">Amount (INR)</label>
                        <input type="number" step="0.01" id="amount" name="amount" placeholder="Enter Amount Here (upto 2 decimal places)" required="required">
                    </li>

                     <li>
                        <label for="datepicker">Invoice Date</label>
                        <input type="text" name="invoice_date" id="datepicker" required="required">
                    </li>
                    <li>
                        <input type="submit" name="Invoice-Form" >
                    </li>
                </ul>

        </fieldset>
       
    </form>
</div>
<?php

    if(isset($_POST['Invoice-Form'])) 
    {
        $invoice_num = $_POST['invoice-num'];
        $contract_num = $_POST['contract-num'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $invoiceDateArray = explode('/', $_POST['invoice_date']);
        $invoice_date = $invoiceDateArray[2].'-'.$invoiceDateArray[0].'-'.$invoiceDateArray[1];

        $file = $_FILES['file']['name'];
        $temp_name = $_FILES['file']['tmp_name'];

        $allowedExts = array("pdf"); 
        $allowedMimeTypes = array('application/pdf');

        $extension = end(explode(".", $file));

        if(!(in_array($extension, $allowedExts)) || !(in_array( $_FILES["file"]["type"], $allowedMimeTypes))){
            echo"<script>alert('Invalid File Type!')</script>";
            echo"<script>window.open('index.php?attach_invoice','_self')</script>";
        }else{     
            move_uploaded_file($temp_name,"uploads/$file"); 
        }

        $input_invoice= "insert into invoice(id,contract_no ,description,file,amount, date) values ('$invoice_num','$contract_num','$description','$file','$amount', '$invoice_date')";
        $query = mysqli_query($conn,$input_invoice);
        if($query){
            echo"<script>alert('Invoice Added Successfully!')</script>"; 
            echo"<script>window.open('index.php?attach_invoice','_self')</script>";
        }
    }
?>