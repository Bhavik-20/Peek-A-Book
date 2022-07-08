<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" type="text/css" href="login.css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    	.error {
	        color: #FF0000;
	        display: inline;
	    }
		.login-form
		{
			margin-top:15%;
			margin-left: 20%;
			margin-right:35%;
		}
		.form-control{
			margin-bottom: 0px;
			margin-top: 0px;
		}
		#snackbar {
          visibility: hidden;
          min-width: 250px;
          margin-left: -125px;
          background-color: #58D68D;
          color: #fff;
          text-align: center;
          border-radius: 5px;
          box-shadow: 1px 1px 15px 6px #BBDEFB;
          padding: 16px;
          position: fixed;
          z-index: 1;
          left: 50%;
          bottom: 30px;
          font-size: 17px;
        }

        .fa {
            color: white;
            margin-right: 5px;
        }

        #snackbar.show {
          visibility: visible;
          -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
          animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
          from {bottom: 0; opacity: 0;} 
          to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
          from {bottom: 0; opacity: 0;}
          to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
          from {bottom: 30px; opacity: 1;} 
          to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
          from {bottom: 30px; opacity: 1;}
          to {bottom: 0; opacity: 0;}
        }


	</style>   
</head>
<body>
	<!--------- JAVASCRIPT VALIDATION OF EMAIL AND PASSWORD -------------->
	<script>
	    function register()
	    {
	      if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById("email_reg").value)==false)
	       alert("You have entered an invalid email address!");
	      else if(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/.test(document.getElementById("pass_reg").value)==false)
	        alert("Password must contain 8 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character");
	      else
	      { //alert("You have succesfully Logged in");
	      	document.getElementById("success").innerHTML ="Sign Up successful!";
	        window.location.href = "UserProfile.php";
	      }
	      return false;
	    }
	    function redirect()
		{
			window.location = "SignIn.php"
		}
	</script>
<!--------- JAVASCRIPT FOR TOAST -------------->
	<script>
	function toast() {
  		var x = document.getElementById("snackbar");
  		x.className = "show";
  		setTimeout(function(){ x.className = x.className.replace("show", ""); }, 5000);
		}
	</script>
	<!--------- JAVASCRIPT VALIDATION OF EMAIL AND PASSWORD -------------->

	<!--------- PHP VALIDATION OF FORM + DATABASE -------------->
	<?php 
	$fname=$sname=$ferr=$serr="";
	$emailErr=$email=$pass="";
	$e=0;
	$p=0;
	$passErr="";
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
		if(empty($_POST["fname"]))
		{
			$ferr="Name required";
		}
		else
		{
			$fname=$_POST["fname"];
		}

		if(empty($_POST["lname"]))
		{
			$serr="Name required";
		}
		else
		{
			$sname=$_POST["lname"];
		}

		if (empty($_POST["email"])) 
		{
			$emailErr = "Email is required";
		} 
		else 
		{
			$email=$_POST["email"];
		if(!filter_var($_POST["email"],FILTER_VALIDATE_EMAIL))
		{
			$emailErr="Invalid Email address";
		}
		else
		{
			$e = "1";
			$email=$_POST["email"];
		} 
		}

		if (empty($_POST["password2"]))
		{
			$passErr = "Password is required"; 
		} 
		else 
		{
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%*]{8,}$/', $_POST["password2"]))
		{
			$passErr="Password must contain 8 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character";
		}
		else
		{
			$p = "1";  
			$pass=$_POST["password2"]; 
		} 
		}

		if($e==1 && $p==1)
		{
		//  -------------------------- Database Usage -----------------------------
		// $conn= mysqli_connect("localhost","root","","BookStore");

		// -------------------------------REMOTE DATABASE CONNECTION --------------
		// $HOST="g1ulxzso4stk.us-east-1.psdb.cloud";
		// $USERNAME="7ky85vsj9r7e";
		// $PASSWORD="pscale_pw_MjVZvRR2vGs9XwZNXzvhwoUOgvKEJpB-4hDrwxcauW8";
		// $DATABASE="peek-a-book";
		// $conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
		include "conn.php";
		$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
	
		if ($conn->connect_error) 
		{
			die("<br>Connection failed: " . $conn->connect_error);
		}
		else
		{
		$checkdb="SELECT * from users where email=?";
		$prep_check=mysqli_prepare($conn,$checkdb);
		mysqli_stmt_bind_param($prep_check,"s",$email);
		mysqli_stmt_execute($prep_check);
		$res=mysqli_stmt_get_result($prep_check);
		if(mysqli_num_rows($res) > 0)
		{
			$emailErr="* User with above email already exists!";
		}

		else
		{
			$hash_pass=password_hash($pass, PASSWORD_DEFAULT);
			$query="insert into users (email,password,fname,lname) VALUES (?,?,?,?)";
			$prep=mysqli_prepare($conn,$query);
			mysqli_stmt_bind_param($prep,"ssss",$email,$hash_pass,$fname,$sname);
			mysqli_stmt_execute($prep);

			sleep(1);
			echo "<script>setTimeout(\"location.href = 'SignIn.php';\",1000);</script>";
		}
		}
		}	
	}
  	?>
	<!--------- PHP VALIDATION OF FORM + DATABASE -------------->
	<div class="sidenav">
		<div class="login-main">
		  	<div class="row" style="margin-left:0px;">
			<img src="Images/book1.jpg" alt="BooksImage" style="width:70px;height:110px; padding-top:20px; margin-right:20px;">
			<h1>Welcome<br>To Book Store</h1>
			<h2>Sign Up to buy your favourite books !</h2>
		</div>
      </div>
	</div>
	</div>
	<div class="main">
		<div class="login-form">
			<form method="POST"  action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
            	 First Name
				<input type="text" class="form-control" id="fname_reg" name="fname" placeholder="First Name" value="<?php echo $fname ?>">
	      		<br><span class="error"><?php echo $ferr; ?></span>
	          	<br>
            </div>
            <div class="form-group">
            	Last Name
				<input type="text" class="form-control" id="lname_reg" name="lname" placeholder="Last Name" value="<?php echo $sname ?>">
	          	<br><span class="error"><?php echo $serr; ?></span>
	      		<br>
			</div>
			<div class="form-group">
				User Email
	      		<input type="text" class="form-control" id="email_reg" name="email" placeholder="Email ID" value="<?php echo $email ?>">
	         	<br><span class="error"><?php echo "$emailErr"; ?></span>
	      		<br>  
			</div>
			<div class="form-group">
				Password
				<input type="password" class="form-control" id="pass_reg" name="password2" placeholder="Password" value="<?php echo $pass ?>">
          		<br><span class="error"><?php echo "$passErr"; ?></span>
			</div>
			<div class="row" style="padding-top:20px;">
				<input type="submit" class="submit-btn" onclick="toast()" value="Register">
				<input type="button" class="register-btn" onclick="redirect()" value="Go To Login">
            </div>
            <div id="snackbar"> <i class="fa fa-check-circle"></i> Sign Up Successful, Redirecting you to Log In!</div>
			</form>
		</div>
	</div>
</body>
</html>