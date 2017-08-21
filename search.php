<?php
    $search_text = mysqli_real_escape_string($conn, $_GET['search']);
    $search = preg_replace("#[^0-9a-z]#i","", $search_text);
    $query = "select * from contract where contract_no like '%$search%'"; 
    $run = mysqli_query($conn,$query);
    ?>
    <div id="page-wrap">
    <h1>Search Results for '<?php echo $search;?>'</h1>
    <table>
        <thead>
            <tr>
                <th>Contract No.</th>
                <th>Description</th>
                <th>Supplier</th>
                <th>Date of Agreement</th>
                <th>View Details</th>
            </tr>
        </thead>
        <tbody>
            <?php
                if(mysqli_num_rows($run)===0){
                    $httpReferer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null;
                    echo "<script>alert('Sorry! No results found');";
                    echo "window.location.href = '$httpReferer';</script>";
                    die();
                }else{
                while($row = mysqli_fetch_array($run)){
                    $contract_num = $row['contract_no'];
                    $description = $row['description'];
                    $supplier = $row['supplier_name'];
                    $date = $row['date_of_agreement'];
            ?>
            <tr>
                <td><?php echo $contract_num; ?></td>
                <td><?php echo $description; ?></td>
                <td><?php echo $supplier;?></td>
                <td><?php echo $date; ?></td>
                <td><a href="index.php?reference-num=<?php echo $contract_num; ?>&updateContract=<?php echo "update"; ?>">View/Edit</a></td>
            </tr>
        
        <?php
            }
        }
        ?>
</div>