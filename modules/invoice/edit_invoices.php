<?php
    if(isset($_SESSION['logged'])!="true")
    {
        header("Location: login.php");
        die();
    }
    if(isset($_GET['edit_invoices'])){
        $invoice_id = mysqli_real_escape_string($conn, $_GET['edit_invoices']);
        $get_invoice = "Select * from invoice where id = '$invoice_id'";
        $result_invoice = mysqli_query($conn,$get_invoice);
        $row_invoice = mysqli_fetch_array($result_invoice);
    }
?>
<h1>Edit Invoice </h1>
<div class="form-container">
    <form method="post" action="" enctype="multipart/form-data" id="form">
        <fieldset>
            <legend>Invoice Details</legend>
                <ul class="form-flex-outer">
                    <li>
                        <label for="invoice-num">Invoice No.</label>
                        <input type="text" id="invoice-num" name="invoice-num" value="<?php echo $row_invoice['id']; ?>" required="required">
                    </li>
                    <li>
                        <label for="invoice-num">Contract No.</label>
                        <input type="text" id="contract-num" name="contract-num" value="<?php echo $row_invoice['contract_no']; ?>" required="required">
                    </li>
                    <li>
                        <label for="description">Description</label>
                        <textarea rows="6" id="description"  name="description"><?php echo $row_invoice['description']; ?></textarea>
                    </li>
                    <li>
                        <label for="invoice-file">File</label>
                        <input id="file" name="file" type="file" attach="pdf" value="<?php echo $row_invoice['file']; ?>" required="required"></input>
                    </li>
                    <li>
                        <label for="amount">Amount (INR)</label>
                        <input type="number" step="0.01" id="amount" name="amount" value="<?php echo $row_invoice['amount']; ?>" required="required">
                    </li>

                     <li>
                        <label for="datepicker">Invoice Date</label>
                        <input type="text" name="invoice_date" id="datepicker" value="<?php 
                            $dateArray = explode('-', $row_invoice['date']);
                            $date = $dateArray[1].'/'.$dateArray[2].'/'.$dateArray[0];
                            echo $date; 
                        ?>" required="required">
                    </li>
                    <li>
                        <input type="submit" name="update_invoice" >
                    </li>
                </ul>
        </fieldset>
    </form>
</div>
<?php

    if(isset($_POST['update_invoice'])) 
    {
        $contract_num = $_POST['contract-num'];
        $description = $_POST['description'];
        $amount = $_POST['amount'];
        $invoiceDateArray = explode('/', $_POST['invoice_date']);
        $invoice_date = $invoiceDateArray[2].'-'.$invoiceDateArray[0].'-'.$invoiceDateArray[1];

        $file = $_FILES['file']['name'];
        $temp_name = $_FILES['file']['tmp_name'];

        $allowedExts = array("pdf", "doc", "docx"); 
        $allowedMimeTypes = array('application/msword','application/pdf');

        $extension = end(explode(".", $file));

        if(!(in_array($extension, $allowedExts)) || !(in_array( $_FILES["file"]["type"], $allowedMimeTypes))){
            echo"<script>alert('Invalid File Type!')</script>";
            echo"<script>window.open('index.php?attach_invoice','_self')</script>";
        }else{     
            move_uploaded_file($temp_name,"uploads/$file");; 
        }


        $input_invoice= "Update invoice set id='$invoice_id',contract_no='$contract_num' ,description='$description',file='$file',amount='$amount', date='$invoice_date' where id='$invoice_id'";
        $query = mysqli_query($conn,$input_invoice);
        if($query){
            echo"<script>alert('Invoice Updated!')</script>"; 
            echo"<script>window.open('index.php?view_invoice','_self')</script>";
        }
    }

?>