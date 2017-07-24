<?php
  if(isset($_SESSION['logged'])!="true")
  {
    header("Location: login.php");
    die();
  }

  if(isset($_GET['settle_issue'])){
   
    $id = $_GET['settle_issue'];
    $settle_issue = "Update issues set status='1' where id = '$id'";
    $result_settle = mysqli_query($conn,$settle_issue);

    if($result_settle){
      echo"<script>alert('Issue has been settled!')</script>";
      echo"<script>window.open('index.php?view_all_issues','_self')</script>";
    }
  }
  mysqli_close($conn);
?>