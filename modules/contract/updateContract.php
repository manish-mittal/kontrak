<?php
    if(isset($_SESSION['logged'])!="true")
    {
        header("Location: login.php");
        die();
    }
    if(isset($_GET['updateContract'])){
        $contract_num = mysqli_real_escape_string($conn, $_GET['reference-num']);
        $get_contract = "Select * from contract where contract_no = '$contract_num'";
        $result_contract = mysqli_query($conn,$get_contract);
        if(!$result_contract){
            die();
            echo"<script>alert('Invalid Contract Number!')</script>"; 
            echo"<script>window.open('index.php?edit_contract','_self')</script>";
        }
        else{
            $row_contract = mysqli_fetch_array($result_contract);
        }

        $category_id = $row_contract['category_id'];
        $get_category = "Select * from category where category_id = '$category_id'";
        $result_category = mysqli_query($conn, $get_category);
        $row_category = mysqli_fetch_array($result_category);

        $language_id = $row_contract['language_id'];
        $get_language = "Select * from language where language_id = '$language_id'";
        $result_language = mysqli_query($conn, $get_language);
        $row_language = mysqli_fetch_array($result_language);

        $country_id = $row_contract['country_id'];
        $get_country = "Select * from country where country_id = '$country_id'";
        $result_country = mysqli_query($conn, $get_country);
        $row_country = mysqli_fetch_array($result_country);

        $currency_id = $row_contract['currency_id'];
        $get_currency = "Select * from currency where currency_id = '$currency_id'";
        $result_currency = mysqli_query($conn, $get_currency);
        $row_currency = mysqli_fetch_array($result_currency);

        $vendor_id = $row_contract['vendor_id'];
        $get_vendor = "Select * from vendor where vendor_id = '$vendor_id'";
        $result_vendor = mysqli_query($conn, $get_vendor);
        $row_vendor = mysqli_fetch_array($result_vendor);

        $sdm_id = $row_contract['sdm_id'];
        $get_sdm = "Select * from service_delivery_manager where sdm_id = '$sdm_id'";
        $result_sdm = mysqli_query($conn, $get_sdm);
        $row_sdm = mysqli_fetch_array($result_sdm);

        $expiration_id = $row_contract['expiration_id'];
        $get_expiration = "Select * from expiration where expiration_id = '$expiration_id'";
        $result_expiration = mysqli_query($conn, $get_expiration);
        $row_expiration = mysqli_fetch_array($result_expiration);

        $renewal_provision_id = $row_expiration['renewal_provision_id'];
        $get_renewal_provision = "Select * from renewal_provision where renewal_provision_id = '$renewal_provision_id'";
        $result_renewal_provision = mysqli_query($conn, $get_renewal_provision);
        $row_renewal_provision = mysqli_fetch_array($result_renewal_provision);
	}
?>

<h1>Update Contract</h1>
<div class="form-container">
    <form method="post" action="" enctype="multipart/form-data" id="form">
        <fieldset>
            <legend>Contract Details</legend>
                <ul class="form-flex-outer">
                    <li>
                        <label for="reference-num">Reference No.</label>
                        <input type="text" id="reference-num" name="reference-num" value="<?php echo $contract_num; ?>" required="required">
                    </li>
                    <li>
                    	<label for="type">Type</label>
                        <select name="contract_type" id="type" required="required">
                            <option value="<?php echo $row_contract['type_id']; ?>" selected="selected"><?php echo $row_contract['type_id']; ?></option>
                            <option value="software">Software</option>
                            <option value="hardware">Hardware</option>
                            <option value="license">License</option>
                            <option value="other">Other</option>
                        </select>
                    </li>
                    <li>
                        <label for="category">Category</label>
                        <select name="category" id="category" required="required">
                            <option value="<?php echo $row_contract['category_id']; ?>" selected="selected"><?php echo $row_category['category']; ?></option>
                            <?php
                                $get_category = "select * from category";
                                $result_category = mysqli_query($conn,$get_category);
                                while($row_category = mysqli_fetch_array($result_category))  {
                                    $category_id = $row_category['category_id'];
                                    $category_name = $row_category['category'];
                                    echo"<option value = '$category_id'>$category_name</option>";
                                }
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="description">Description</label>
                        <textarea rows="6" id="description" name="description"><?php echo $row_contract['description']; ?></textarea>
                    </li>
                    <li>
                        <label for="datepicker">Date of Agreement</label>
                        <input type="text" name="date" id="datepicker" value="<?php 
                        	$dateArray = explode('-', $row_contract['date_of_agreement']);
        					$date = $dateArray[1].'/'.$dateArray[2].'/'.$dateArray[0];
        					echo $date; 
        				?>" required="required">
                    </li>
                    <li>
                        <label for="language">Language</label>
                        <select name="language" id="language" required="required">
                            <option value="<?php echo $row_contract['language_id']; ?>" selected="selected"><?php echo $row_language['language']; ?></option>
                            <?php
                                $get_language = "select * from language";
                                $result_language = mysqli_query($conn,$get_language);
                                while($row_language = mysqli_fetch_array($result_language))  {
                                    $language_id = $row_language['language_id'];
                                    $language_name = $row_language['language'];
                                    echo"<option value = '$language_id'>$language_name</option>";
                                }
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="life">Total Committed Value (Years)</label>
                        <input type="number" step="0.1" name="life" id="life" value="<?php echo $row_contract['life_of_contract']; ?>" required="required">
                    </li>
                    <li>
                        <label for="supplier">Name of Supplier</label>
                        <input type="text" name="supplier" id="supplier" value="<?php echo $row_contract['supplier_name']; ?>" required="required">
                    </li>
                    <li>
                        <label for="country">Country</label>
                        <select name="country" id="country" required="required">
                            <option value="<?php echo $row_contract['country_id']; ?>" selected="selected"><?php echo $row_country['country']; ?></option>
                            <?php
                                $get_country = "select * from country";
                                $result_country = mysqli_query($conn,$get_country);
                                while($row_country = mysqli_fetch_array($result_country))  {
                                    $country_id = $row_country['country_id'];
                                    $country_name = $row_country['country'];
                                    echo"<option value = '$country_id'>$country_name</option>";
                                }
                            ?>
                        </select>
                    </li>
                </ul>
        </fieldset>
        <fieldset>
            <legend>Payment Details</legend>
                <ul class="form-flex-outer">
                    <li>
                        <label for="currency">Currency</label>
                        <select name="currency" id="currency" required="required">
                            <option selected="selected" value="<?php echo $row_contract['currency_id']; ?>"><?php echo $row_currency['currency']; ?></option>
                            <?php
                                $get_currency = "select * from currency";
                                $result_currency = mysqli_query($conn,$get_currency);
                                while($row_currency = mysqli_fetch_array($result_currency))  {
                                    $currency_id = $row_currency['currency_id'];
                                    $currency_name = $row_currency['currency'];
                                    echo"<option value = '$currency_id'>$currency_name</option>";
                                }
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="spend">Annual Spend</label>
                        <input type="number" step="0.01" name="spend" id="spend" value="<?php echo $row_contract['annual_spend']; ?>">
                    </li>
                    <li>
                        <label for="terms">Terms</label>
                        <textarea rows="6" name="terms" id="terms"><?php echo $row_contract['payment_terms']; ?></textarea>
                    </li>
                    <li>
                        <label for="status">Status</label>
                        <input type="text" id="status" name="status" value="<?php echo $row_contract['status']; ?>" required="required">
                    </li>
                </ul>
        </fieldset>
         <fieldset>
            <legend>Vendor Details</legend>
                <ul class="form-flex-outer">
                    <li>
                        <label for="vendor_name">Name</label>
                        <input type="text" id="vendor_name" name="vendor_name" value="<?php echo $row_vendor['contact_name']; ?>" required="required">
                    </li>
                    <li>
                        <label for="vendor_email">Email</label>
                        <input type="email" id="vendor_email" name="vendor_email" value="<?php echo $row_vendor['email']; ?>" required="required">
                    </li>
                    <li>
                        <label for="vendor_contact">Contact Number</label>
                        <input type="tel" id="vendor_contact" name="vendor_contact" value="<?php echo $row_vendor['phone_no']; ?>" required="required">
                    </li>
                </ul>
        </fieldset>
        <fieldset>
            <legend>Service Delivery Manager</legend>
                <ul class="form-flex-outer">
                    <li>
                        <label for="sdm_name">Name</label>
                        <input type="text" id="sdm_name" name="sdm_name" value="<?php echo $row_sdm['name']; ?>" required="required">
                    </li>
                    <li>
                        <label for="sdm_email">Email</label>
                        <input type="email" id="sdm_email" name="sdm_email" value="<?php echo $row_sdm['email']; ?>" required="required">
                    </li>
                    <li>
                        <label for="sdm_contact">Contact</label>
                        <input type="tel" id="sdm_contact" name="sdm_contact" value="<?php echo $row_sdm['phone_no']; ?>" required="required">
                    </li>
                    <li>
                        <label for="remarks">Remarks</label>
                        <textarea rows="6" name="remarks" id="remarks"><?php echo $row_contract['sdm_remarks']; ?></textarea>
                    </li>
                </ul>
        </fieldset>
        <fieldset>
            <legend>Contract Expiration and Notices</legend>
                <ul class="form-flex-outer">
                    <li>
                        <label for="e-datepicker">Expiration Date</label>
                        <input type="text" name="expiration_date" id="e-datepicker" value="<?php
                        	$e_dateArray = explode('-', $row_expiration['date']);
        					$e_date = $e_dateArray[1].'/'.$e_dateArray[2].'/'.$e_dateArray[0];
        					echo $e_date;
        				?>" required="required">
                    </li>
                    <li>
                        <label for="renewal_provision">Renewal Provision</label>
                        <select name="renewal_provision" id="renewal_provision" required>
                            <option selected="selected" value="<?php echo $row_expiration['renewal_provision_id']; ?>"><?php echo $row_renewal_provision['renewal_provision']; ?></option>
                            <?php
                                $get_renewal_provision = "select * from renewal_provision";
                                $result_renewal_provision = mysqli_query($conn,$get_renewal_provision);
                                while($row_renewal_provision = mysqli_fetch_array($result_renewal_provision))  {
                                    $renewal_provision_id = $row_renewal_provision['renewal_provision_id'];
                                    $renewal_provision_name = $row_renewal_provision['renewal_provision'];
                                    echo"<option value = '$renewal_provision_id'>$renewal_provision_name</option>";
                                }
                            ?>
                        </select>
                    </li>
                    <li>
                        <label for="termination_provision">Termination Rights / Provision</label>
                        <textarea rows="6" name="termination_provision" id="termination_provision"><?php echo $row_expiration['termination_rights']; ?></textarea>
                    </li>
                    <li>
                        <label for="assignment_provision">Assignment Provision</label>
                        <input type="text" id="assignment_provision" name="assignment_provision" value="<?php echo $row_expiration['assignment_provision']; ?>" required="required">
                    </li>
                    <li>
                        <input type="submit" name="update_contract" value="Update">
                    </li>
                </ul>
        </fieldset>
    </form>
</div>
<?php
    if(isset($_POST['update_contract'])) 
    {	
    	$vendor = $row_vendor['vendor_id'];
    	$sdm = $row_sdm['sdm_id'];
    	$expiration = $row_expiration['expiration_id'];
        $reference_num = mysqli_real_escape_string($conn,$_POST['reference-num']);
        $contract_type = mysqli_real_escape_string($conn, $_POST['contract_type']);
        $category = mysqli_real_escape_string($conn,$_POST['category']);
        $description = mysqli_real_escape_string($conn,$_POST['description']);
        $dateArray = explode('/', $_POST['date']);
        $date = $dateArray[2].'-'.$dateArray[0].'-'.$dateArray[1];
        $language = mysqli_real_escape_string($conn,$_POST['language']);
        $life = mysqli_real_escape_string($conn,$_POST['life']);
        $supplier = mysqli_real_escape_string($conn,$_POST['supplier']);
        $country = mysqli_real_escape_string($conn,$_POST['country']);
        $currency = mysqli_real_escape_string($conn,$_POST['currency']);
        $spend = mysqli_real_escape_string($conn,$_POST['spend']);
        $terms = mysqli_real_escape_string($conn,$_POST['terms']);
        $status = mysqli_real_escape_string($conn,$_POST['status']);
        $vendor_name = mysqli_real_escape_string($conn,$_POST['vendor_name']);
        $vendor_email = mysqli_real_escape_string($conn,$_POST['vendor_email']);
	    $vendor_contact = mysqli_real_escape_string($conn,$_POST['vendor_contact']);
        $sdm_name = mysqli_real_escape_string($conn,$_POST['sdm_name']);
        $sdm_email = mysqli_real_escape_string($conn,$_POST['sdm_email']);
        $sdm_contact = mysqli_real_escape_string($conn,$_POST['sdm_contact']);
        $remarks = mysqli_real_escape_string($conn,$_POST['remarks']); //Insert rest into expiration
        $expirationDateArray = explode('/', $_POST['expiration_date']);
        $expiration_date = $expirationDateArray[2].'-'.$expirationDateArray[0].'-'.$expirationDateArray[1];
        $renewal_provision = mysqli_real_escape_string($conn,$_POST['renewal_provision']);
        $termination_provision = mysqli_real_escape_string($conn, $_POST['termination_provision']);
        $assignment_provision = mysqli_real_escape_string($conn,$_POST['assignment_provision']);

        $update_vendor = "Update vendor set contact_name = '$vendor_name', email = '$vendor_email', phone_no = '$vendor_contact' where vendor_id='$vendor'";
        mysqli_query($conn, $update_vendor);

        $update_sdm = "Update service_delivery_manager set name = '$sdm_name', email = '$sdm_email', phone_no = '$sdm_contact' where sdm_id='$sdm'";
        mysqli_query($conn, $update_sdm);

        $update_expiration = "Update expiration set contract_no = '$reference_num', date = '$expiration_date', renewal_provision_id = '$renewal_provision', termination_rights = '$termination_provision', assignment_provision = '$assignment_provision' where expiration_id='$expiration'";
        mysqli_query($conn, $update_expiration);

        $update_contract = "Update contract set contract_no = '$reference_num', type_id = '$contract_type', category_id = '$category', description = '$description', date_of_agreement = '$date', language_id = '$language', supplier_name = '$supplier', country_id = '$country', life_of_contract = '$life', vendor_id = '$vendor', sdm_id = '$sdm', sdm_remarks = '$remarks', currency_id = '$currency', annual_spend = '$spend', payment_terms = '$terms', status = '$status', expiration_id = '$expiration' where contract_no = '$contract_num'";
	    $result_contract = mysqli_query($conn,$update_contract);
	  
	    if($result_contract){
            echo"<script>alert('Contract details updated successfully!')</script>"; 
            echo"<script>window.open('index.php?new_contract','_self')</script>";
	    }
	    else{
	    	echo "<script>alert('Fail! Some Error Occurred.')</script>";
	    }
	}
?>