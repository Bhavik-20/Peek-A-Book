<?php 
/*----------------PHP sessions and Cookies-------------------------*/
  session_start();
  $cookie_name="auto_login";
  if(isset($_COOKIE[$cookie_name]))
    {
      header("Location:HomePage_In.php");
    }
/*----------------PHP sessions and Cookies-------------------------*/
?>
<!DOCTYPE html>
<html>
<head>
	<title>Peek-A-Book | Sign In</title>
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
	    .try{
	        display: block;
	        color: #FF0000;
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
        .goto{
        margin: 30px 0px 0px 120px;
        padding: 10px 20px;
        background-color: #AED6F1;
        border: 1px solid white;
        border-radius: 30px;
        color: white; 
        cursor: pointer;
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

		function login()
		{
			if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(document.getElementById("email_user").value)==false)
			alert("You have entered an invalid email address!");

			else if(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/.test(document.getElementById("pass_user").value)==false)
			alert("Password must contain 8 to 15 characters which contain at least one lowercase letter, one uppercase letter, one numeric digit, and one special character");

			else
			{
			document.getElementById("success").innerHTML ="Logging You In..";   
			}
			return false; 
		}

		function redirect()
		{
			window.location = "SignUp.php"
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
	require 'conn.php';
	$emailErr=$email=$pass="";
    $e=0;
    $p=0;
    $passErr="";
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{
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
		if (empty($_POST["password"]))
		{
			$passErr = "Password is required";   
		} 
		else 
		{
		if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,}$/', $_POST["password"]))
		{
			$passErr="Invalid Password";
		}
		else
		{
			$p = "1";  
			$pass=$_POST["password"]; 
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
		$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);


		if ($conn->connect_error) 
		{
			die("<br>Connection failed: " . $conn->connect_error);
		}
		else
		{
			$checkdb="SELECT password from users where email=?";
			$prep_check=mysqli_prepare($conn,$checkdb);
			mysqli_stmt_bind_param($prep_check,"s",$email);
			mysqli_stmt_execute($prep_check);
			$res=mysqli_stmt_get_result($prep_check);
			if(mysqli_num_rows($res)==1)
			{	
				$res2=mysqli_fetch_array($res);
				$res2=$res2['password'];
				$get_id="SELECT id from users where email=? and password=?";
				$check=mysqli_prepare($conn,$get_id);
				mysqli_stmt_bind_param($check,"ss",$email,$res2);
				mysqli_stmt_execute($check);
				$res_id=mysqli_stmt_get_result($check);
				$res_id2=mysqli_fetch_array($res_id);
				$res_id2=$res_id2['id'];
				if(password_verify($pass, $res2))
				{ 
					$_SESSION['user_id']=$res_id2;
					sleep(1);
					echo "<script>setTimeout(\"location.href = 'HomePage_In.php';\",1000);</script>";
				}
				else
				{
					$passErr="Invalid Username or Password.";
				}
			}
			else
			{
				$emailErr="Invalid Email address";
			}
		}			
		}
    }
  	?>
	<!--------- PHP VALIDATION OF FORM + DATABASE -------------->

	<div class="sidenav">
		<div class="login-main">
		  	<div class="row" style="margin-left:0px;">
			<img src="images/book1.jpg" alt="BooksImage" style="width:70px;height:110px; padding-top:20px; margin-right:20px;">
			<h1>Welcome<br>To Peek-A-Book</h1>
			<h2>Sign In to buy your favourite books !</h2>
		</div>
      </div>
	</div>
	<div class="main">
		<div class="login-form">
			<form  method="POST"  action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="form-group">
				<label>User Email</label>
				<div class="row" style="margin:0px;">
				<input type="text" class="form-control" id="email_user" name="email" placeholder="Email ID" value="<?php echo $email ?>">
				<p class="error">*</p>
				</div>
				<br><p class="error"><?php echo "$emailErr"; ?></p>
			</div>
			<div class="form-group">
				<label>Password</label>
				<input type="password" class="form-control" id="pass_user" name="password" placeholder="Password" value="<?php echo $pass ?>">  <p class="error">*</p>
          		<br><p class="error"><?php echo "$passErr"; ?></p>
			</div>
			<div class="row" style="padding-top:20px;">
				<input type="submit" class="submit-btn" name="LP_sub" onclick="toast()" value="Log In">  
				<input type="button" class="register-btn" onclick="redirect()" value="Register">
	        </div>
	        <div>
	        	<input type="button" class="goto" onclick="window.location='Admin_login.php'" value="Admin Login">
	        </div>
	        <div id="snackbar"> <i class="fa fa-check-circle"></i> Sign In Successful, Redirecting you to your Account!</div>
			</form>
		</div>
	</div>
</body>
</html>