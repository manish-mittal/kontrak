<?php
	include ("config.php");
	require_once "vendor/phpmailer/phpmailer/PHPMailerAutoload.php";
	if(isset($_SESSION['logged'])!="")
	{
 		header("Location: index.php");
	}
	if(isset($_POST['reset']))
	{
 		$email = mysqli_real_escape_string($conn,$_POST['r_email']);
 		$select = "SELECT * FROM users WHERE email='$email'";
 		$result = mysqli_query($conn,$select);
 		if($row = mysqli_fetch_array($result))
 		{
			$mail = new PHPMailer;

			//Enable SMTP debugging. 
			$mail->SMTPDebug = false;                               
			//Set PHPMailer to use SMTP.
			$mail->isSMTP();            
			//Set SMTP host name                          
			$mail->Host = "smtp.gmail.com";
			//Set this to true if SMTP host requires authentication to send email
			$mail->SMTPAuth = true;                          
			//Provide username and password     
			$mail->Username = "kontrak.care@gmail.com";                 
			$mail->Password = "Kontrak@1";                           
			//If SMTP requires TLS encryption then set it
			$mail->SMTPSecure = "tls";                           
			//Set TCP port to connect to 
			$mail->Port = 587;                                   

			$mail->From = "kontrak.care@gmail.com";
			$mail->FromName = "Kontrak Care";

			$mail->addAddress($email);

			$mail->isHTML(true);

			$mail->Subject = "Subject Text";
			$mail->Body = "<i>Your Password is : ".$row['password']."</i>";
			$mail->AltBody = "Your Password is : ".$row['password'];

			if(!$mail->send()) 
			{
			    echo "Mailer Error: " . $mail->ErrorInfo;
			} 
			else 
			{
			    echo "<script>alert('Password sent to the registered email id.');</script>";
			    echo"<script>window.open('login.php','_self')</script>";
			}
 		}
 		else
 		{
    		echo "<script>alert('Email does not exist');</script>";
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
		<form action="" method="post" name="Reset_Password_Form" class="form-signin">       
		    <h3 class="form-signin-heading">KonTrak</h3>
			  <hr class="colorgraph"><br>
			  	<input type="email" class="form-control" name="r_email" placeholder="Enter Registered Email" required="" autofocus="" /><br>
			  <button class="btn btn-lg btn-primary btn-block" name="reset" type="Submit">Reset</button><br>
			  <p>Go Back to <a href="login.php">Login</a> Page</p>	
		</form>			
	</div>
</div>
</div>
</body>
</html>