<?php
	include ("config.php");

	if(isset($_SESSION['logged'])!="")
	{
 		header("Location: index.php");
	}

	if(isset($_POST['login']))
	{
 		$email = mysqli_real_escape_string($conn,$_POST['email']);
 		$password = mysqli_real_escape_string($conn,$_POST['password']);
 		$select = "SELECT * FROM users WHERE email='$email'";
 		$result = mysqli_query($conn,$select);
 		if($result)
 		{
 			$row = mysqli_fetch_array($result);
 			if($row['password'] == $password)
 			{
  				$_SESSION['logged'] = "true";
  				header("Location: index.php");
 			}
 			else{
 				echo "<script>alert('Incorrect Password. Please try again.');</script>";
 			}
 		}
 		else
 		{
    		echo "<script>alert('Incorrect Email Id or User does not exist!');</script>";
 		}
	}
?>
<!Doctype HTML>
<html>
<head>
	<title>Reset Password | KonTrak</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
	<div class = "container">
	<div class="wrapper">
		<form action="" method="post" name="Login_Form" class="form-signin">       
		    <h3 class="form-signin-heading">KonTrak</h3>
			  <hr class="colorgraph"><br>
			  	<input type="email" class="form-control" name="r_email" placeholder="Enter Registered Email" required="" autofocus="" /><br>
			  <button class="btn btn-lg btn-primary btn-block" name="r_email" type="Submit">Reset</button><br>
			  <p>Go Back to <a href="login.php">Login</a> Page</p>	
		</form>			
	</div>
</div>
</div>
</body>
</html>