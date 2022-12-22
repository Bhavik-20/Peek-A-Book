<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Peek-A-Book | Contact Us</title>
    <link rel="stylesheet" type="text/css" href="ContactStyleSheet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    	.captcha{
    		 border: 1px solid #555;
    		 width:125px;
    		 border-radius: 5px;
    		 background-color: 	blue;
    		 height:40px;
    		 margin-top: 5px;	
    	}
    </style>
</head>
<body style="background-color:#E3F2FD;">

<?php 
if(isset($_SESSION['user_id']))
  {
    include "Header_file.php";
  }
  else
  {
    include "Header_All.php";
  }
  $captcha	=0;
  if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_POST['LP_sub']))
        {
            $a=empty($_POST['FirstName']);
            $b=empty($_POST['LastName']);
            $c=empty($_POST['Email']);
            $d=empty($_POST['Subject']);
            $e=empty($_POST['Message']);
            if(isset($_SESSION['captcha']) && isset($_POST['Captcha']))
            {
            	if($_SESSION['captcha']!=$_POST['Captcha'])
            
            {
            	echo "<script>alert('Invalid Captcha');</script>";
            }
            else {
            	$captcha=1;
            }
    		}

            if($a==1 || $b==1 || $c==1 || $d==1 || $e==1)
            {
                // echo "<script> window.location.href='OrderPlaced.php' </script>";
                // echo "no";
                echo "<script>alert('Please fill in all the fields.');</script>";
            }
            else if($captcha==1)
            {
                echo "<script> window.location.href='Thankyou_Message.php' </script>";
            }
        }
    }
?>
<div class="contain" style="height: 150px, width:100%;">
        <img src="images/book_shelf.jpg" alt="Image">
        <div class="text-block">
            <h1>Contact Us</h1>
  </div>
  <div class="text-block2">
        <!-- <p>Email Id: bookstore@gmail.com </p>
        <p>Phone: 9898989898 </p> -->
        <div class="row">
            <a href="https://www.facebook.com/" class="fa fa-facebook"></a>
            <a href="https://twitter.com/" class="fa fa-twitter"></a>
            <a href="https://www.linkedin.com/" class="fa fa-linkedin"></a>
            <a href="https://www.instagram.com/" class="fa fa-instagram"></a>
        </div>
  </div>
</div>
<br>
<br>
    <form method="POST" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <center>
            <div class="top">
                <h1>Lets Talk About Books!</h1>
            </div>
            <br>
            <div class="box" >
                <div class="block1">
                    <div class="profilea"> 
                        <input type="text" name="FirstName" class="inputa" placeholder="First Name">
                        <br>
                        <input type="text" name="LastName" class="inputa" placeholder="Last Name"> 
                    </div>
                </div>
                <br>
                <input type="text" name="Email" class="inputa" placeholder="Email">  
                <br><br>
                <input type="text" name="Subject" class="inputa" placeholder="Subject">  
                <br><br>
                <input type="textarea" name="Message" class="inputa" placeholder="Feedback">  
                <br><br>
                <div class="profilea">
                <img src="Captcha.php" class="captcha" alt="Captcha Image">
                <input type="text" name="Captcha" class="inputa" placeholder="Enter Captcha Text Here">
            	</div>
                <br><br>
                <input type="submit" class="submit-btn" name="LP_sub" value="Submit"> 
            </div>
            <br><br>
        </center>
    </form>
<br><br><br>

<p></p>
<?php include "Footer.php"?>
 
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
</body>
</html>