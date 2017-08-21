<?php
	include('config.php');
	include('modules/notification/update_notifications.php');
	if(isset($_SESSION['logged'])!="true")
	{
 		header("Location: login.php");
 		die();
	}
?>
<!Doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Manish Mittal">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/table_style.css">
	<link rel="stylesheet" href="css/form_style.css">
	<script src="js/modernizr.js"></script>
  	
	<title>KonTrak</title>
</head>
<body>
	<header class="cd-main-header">
		<a href="index.html" class="cd-logo"><img src="img/cd-logo.svg" alt="Logo"></a>
		
		<div class="cd-search is-hidden">
			<form action="index.php?search">
				<input type="search" placeholder="Search..." name="search">
			</form>
		</div>

		<a href="#" class="cd-nav-trigger">Menu<span></span></a>

		<nav class="cd-nav">
			<ul class="cd-top-nav">
				<li class="has-children account">
					<a href="#">
						<img src="img/cd-avatar.png" alt="avatar">
						Account
					</a>
					<ul>
						<li><a href="index.php?logout">Logout</a></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header>

	<main class="cd-main-content">
		<nav class="cd-side-nav">
			<ul>
				<li class="cd-label">Main</li>
				<li class="has-children overview active">
					<a>Manage Contracts</a>
					<ul>
						<li><a href="index.php?new_contract">Add New Contract</a></li>
						<li><a href="index.php?edit_contract">Edit Contract</a></li>
						<li><a href="index.php?categories">Contract Categories</a></li>
					</ul>
				</li>
				<li class="has-children notifications">
					<a href="index.php?view_all_notifications">Notifications<span class="count">
					<?php
 						$get_notifications = "select * from notification where viewed = 0";
 						$result = mysqli_query($conn,$get_notifications);
 						$i = 0;
 						if(mysqli_num_rows($result) == 0){
 							echo "0";
 						}
						else{
							while($row_issues = mysqli_fetch_array($result))
							{
	 							$status = $row['status'];
	 							if($status==0)
	 							$i++;
							}
							echo $i;
						}
 					?>
 					</span></a>
					<ul>
						<li><a href="index.php?all_notifications">View All</a></li>
					</ul>
				</li>

				<li class="has-children comments">
					<a>Reviewer Comments</a>
					
					<ul>
						<li><a href="index.php?add_review">Add Review</a></li>
						<li><a href="index.php?view_all_reviews">All Reviews</a></li>
					</ul>
				</li>

				<li class="has-children comments">
					<a>Notice Periods</a>
					
					<ul>
						<li><a href="index.php?add_notice_period">Add Notice Period</a></li>
						<li><a href="index.php?view_all_notices">View All</a></li>
					</ul>
				</li>

				<li class="has-children bookmarks">
					<a href="index.php?view_all_vendor">View All Vendors</a>
				</li>
			</ul>

			<ul>
				<li class="cd-label">Invoice Management</li>
				<li class="has-children bookmarks">
					<a href="index.php?attach_invoice">Attach an Invoice</a>
				</li>
				<li class="has-children images">
					<a href="index.php?view_invoice">Invoice Details</a>
				</li>

				<li class="has-children users">
					<a href="index.php?generate_report">Generate Report</a>
				</li>
			</ul>
			<ul>
				<li class="cd-label">Action</li>
				<li class="has-children bookmarks">
					<a href="index.php?view_all_issues">View Issues</a>
				</li>
				<li class="action-btn"><a href="index.php?submit_issue">+ Submit an Issue</a></li>
			</ul>
		</nav>

		<div class="content-wrapper">
			<?php
				if(isset($_GET['search'])){
                    include("search.php"); 
                }
				if(isset($_GET['new_contract'])){
                    include("modules/contract/new_contract.php"); 
                }
                if(isset($_GET['edit_contract'])){
                    include("modules/contract/edit_contract.php"); 
                }
                if(isset($_GET['updateContract'])){
                    include("modules/contract/updateContract.php"); 
                }
                if(isset($_GET['categories'])){
                    include("modules/category/categories.php"); 
                }
                if(isset($_GET['edit_category'])){
                    include("modules/category/edit_category.php"); 
                }
                if(isset($_GET['delete_category'])){
                    include("modules/category/delete_category.php"); 
                }
                if(isset($_GET['view_all_notifications'])){
                    include("modules/notification/view_all_notifications.php"); 
 	            }
 	            if(isset($_GET['all_notifications'])){
                    include("modules/notification/all_notifications.php"); 
 	            }
                if(isset($_GET['add_notice_period'])){
                    include("modules/notice/add_notice_period.php"); 
                }
                if(isset($_GET['view_all_notices'])){
                    include("modules/notice/view_all_notices.php"); 
                }
                if(isset($_GET['edit_notice'])){
                    include("modules/notice/edit_notice.php"); 
                }
                if(isset($_GET['delete_notice'])){
                    include("modules/notice/delete_notice.php"); 
                }
                if(isset($_GET['view_all_vendor'])){
                    include("modules/vendor/view_all_vendor.php"); 
                }
                if(isset($_GET['edit_vendor'])){
                    include("modules/vendor/edit_vendor.php"); 
                }
                if(isset($_GET['delete_vendor'])){
                    include("modules/vendor/delete_vendor.php"); 
                }
                if(isset($_GET['add_review'])){
                    include("modules/review/add_review.php"); 
                }
                if(isset($_GET['view_all_reviews'])){
                    include("modules/review/view_all_reviews.php"); 
                }
                if(isset($_GET['edit_review'])){
                    include("modules/review/edit_review.php"); 
                }
                if(isset($_GET['delete_review'])){
                    include("modules/review/delete_review.php"); 
                }
                if(isset($_GET['view_all_issues'])){
                    include("modules/issue/view_all_issues.php"); 
                }
                if(isset($_GET['submit_issue'])){
                    include("modules/issue/submit_issue.php"); 
                }
                if(isset($_GET['settle_issue'])){
                    include("modules/issue/settle_issue.php"); 
                }
                if(isset($_GET['attach_invoice'])){
                    include("modules/invoice/attach_invoice.php"); 
                }
                if(isset($_GET['view_invoice'])){
                    include("modules/invoice/view_invoice.php"); 
                }
                if(isset($_GET['view_invoices'])){
                    include("modules/invoice/view_invoices.php"); 
                }
                if(isset($_GET['edit_invoices'])){
                    include("modules/invoice/edit_invoices.php"); 
                }
                if(isset($_GET['generate_report'])){
                    include("modules/invoice/generate_report.php"); 
                }
				if(isset($_GET['logout'])){
                    include("logout.php"); 
                }
			?>
		</div>
	</main>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<script src="js/jquery.menu-aim.js"></script>
<script src="js/main.js"></script>
<script>
    $(function() {
        $("#datepicker").datepicker();
    });
    $(function() {
        $("#e-datepicker").datepicker();
    });
</script>
</body>
</html>