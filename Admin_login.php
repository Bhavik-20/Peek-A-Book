<?php 
  session_start();
  $cookie_name="admin_auto_login";
  if(isset($_COOKIE[$cookie_name]))
    {
      header("Location:Admin_home.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book Store Admin Sign In Page</title>
	<link rel="stylesheet" type="text/css" href="Authenticate_StyleSheet.css">
    <style>
    .error {
        color: #FF0000;
        display: inline;
    }
    .try{
        display: block;
        color: #FF0000;
    }
    
</style>
</head>
<body>
<br>
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
          //window.location.href = "UserProfile.php";     
        }
      return false; 
    }
  </script>

<!-- -------------------------Php validation of form------------------------------- 
password hashing in phpmyadmin: UPDATE `admins` SET `password`=sha1(password) WHERE id=4  -->    
   <?php
    require "conn.php";
    $nameErr=$name=$pass="";
    $e=0;
    $p=0;
    $passErr="";
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      if (empty($_POST["name_admin"])) 
      {
        $nameErr = "Name is required";
      } 
      else 
      {
        $name=$_POST["name_admin"];
        $e = "1";  
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
          // Check connection
          if ($conn->connect_error) 
          {
            die("<br>Connection failed: " . $conn->connect_error);
          }
          else
          {             
            $checkdb="SELECT password from admins where name=?";
            $prep_check=mysqli_prepare($conn,$checkdb);
            mysqli_stmt_bind_param($prep_check,"s",$name);
            mysqli_stmt_execute($prep_check);
            $res=mysqli_stmt_get_result($prep_check);

            if(mysqli_num_rows($res)==1)
            {
              $res2=mysqli_fetch_array($res);
              $res2=$res2['password'];
              $hash_pass=sha1($pass);
              $get_id="SELECT id from admins where name=? and password=?";
              $check=mysqli_prepare($conn,$get_id);
              mysqli_stmt_bind_param($check,"ss",$name,$hash_pass);
              mysqli_stmt_execute($check);
              $res_id=mysqli_stmt_get_result($check);
              $res_id2=mysqli_fetch_array($res_id);
                
              
              if(strcmp($hash_pass,$res2)==0 )
              { 
              	$res_id2=$res_id2['id'];
                $_SESSION['admin_id']=$res_id2;
                echo "<center><h1>Sign In Successful, Redirecting you to your Account!</h1></center>";
                echo "<script>setTimeout(\"location.href = 'Admin_home.php';\",1500);</script>";
              }
              else
              {
                $passErr="Invalid Username or Password.";
              }
              }
              else
              {
                $nameErr="Invalid Username";
              }
          }
        }
    }
//onsubmit="return login()"
  ?>
<!-- -------------------------Php validation of form ends------------------------------- -->  

  <form  method="POST"  action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <center>
      <img src="Images/book1.jpg" alt="BooksImage" style="width:50px;height:60px;">
    	<div class="top">
      	<h1>Admin Sign In</h1>
      </div>
      <br><br>
      <div class="box">
        <div class="input_div">
      		<input type="text" class="inputa" id="name_admin" name="name_admin" placeholder="Admin Name" value="<?php echo $name ?>">	<p class="error">*</p>
          <br><p class="error"><?php echo "$nameErr"; ?></p>
          <br> <!-- added this br tag -->
      		<input type="password" class="inputa" id="pass_admin" name="password" placeholder="Password" value="<?php echo $pass ?>">  <p class="error">*</p>
          <br><p class="error"><?php echo "$passErr"; ?></p>
        </div> 
      		<br>
          <input type="submit" class="submit-btn" name="LP_sub"	value="Log In">  
      </div>

        <br><br>

        <div class="new">
      		<!-- <a href="SignUp.php">New here ? Click here to Sign Up!</a>	 -->
      		<p id="success"></p>
        </div>

    </center>
     
  </form>
</body>
</html>