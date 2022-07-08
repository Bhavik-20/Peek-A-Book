<!DOCTYPE html>
<html>
<head>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Lobster&display=swap');
		.navbar-brand h1{
		display: inline;
		font-size: x-large;
		font-family: 'Lobster', cursive;
		}

		.navbar-dark .navbar-nav .nav-item .nav-link {
		color:white;
		} 
		.dropdown .fa{
		color: grey;
		}
	</style>
</head>
<body >
  <!--Navigation Bar-->

  <nav class="navbar sticky-top navbar-expand navbar-dark bg-dark" >
    <a class="navbar-brand" href="HomePage_In.php"><h1>Book Store</h1></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="HomePage_In.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="ContactUs.php">Contact Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="AboutUs.php">About Us</a>
      </li>
    </ul>
  </div>
    <!-- Search form -->
		<div class="input-group-prepend" >
			<span class="input-group-text cyan lighten-2" id="basic-text1" style="height: 25px;"><i class="fa fa-search text-black"></i></span>
		</div>
		<!-- <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search" > -->
    <?php include "SearchTry.php" ?>

	<br><br>
	<!-- Search form ends -->
    <ul class="navbar-nav" style="float: right; color:white;margin-left: 10px;">
      <li>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-4" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      </button>
      <div class="collapse navbar-collapse" id="navbar-list-4">
      <ul class="navbar-nav" style="margin-right:10px;">
        <li class="dropdown" style="margin-right:10px;" >
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php
          if(isset($_SESSION['user_id']))
          {
            // $con= mysqli_connect("localhost","root","","BookStore");
            include "conn.php";
	          $con= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
            // Check connection
            if ($con->connect_error) 
            {
              die("<br>Connection failed: " . $con->connect_error);
            }
            else
            {
              $id=$_SESSION['user_id'];
              $imgdb="select display_pic from users where id=?";
              $prep_img=mysqli_prepare($con,$imgdb);
              if($prep_img == false) 
              {
                die("<pre>".mysqli_error($con).PHP_EOL.$imgdb."</pre>");
              }
              mysqli_stmt_bind_param($prep_img,"i",$id);
              mysqli_stmt_execute($prep_img);
              $res=mysqli_stmt_get_result($prep_img);
              $res=mysqli_fetch_array($res);
              if(is_null($res['display_pic'])==FALSE)
              {

                echo '<img height="35" width="35" style="border-radius:50%;" src="data:image;base64,'.$res['display_pic'].'">';
              }
              else
              {
                echo "<img src='images/Default_user.jpg'  height=35 width=35 style='border-radius:50%; '/>";
              }
              mysqli_close($con);
            }
            }
          ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="text-align:justify; min-width:20px;">
          <a class="dropdown-item" href="UserProfile.php" style="padding:10px 15px;"><span><i class="fa fa-user" style="margin-right:10px;"></i></span>Edit Profile</a>
          <a class="dropdown-item" href="Wishlist.php" style="padding:10px 10px;"><span><i class="fa fa-heart" style="font-size:15px;margin-right:10px;"></i></span>Wishlist</a>
           <a class="dropdown-item" href="Orders.php" style="padding:10px 15px;"><span><i class="fa fa-history" style="font-size:15px;margin-right:10px;"></i></span>Order History</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="SigningOut.php" style="padding:10px 15px;"><span><i class="fa fa-sign-out" style="margin-right:10px;"></i></span>Sign Out</a> 
          <?php 
          $_SESSION['sign_out']='true';
           ?>
        </div>
      </li> 
      <li>
        <a class="nav-link " href="Cart.php">
          <span>
          <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-cart4" fill="white" xmlns="http://www.w3.org/2000/svg">
          <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
          </svg>
          </span> 
        </a>
      </li>  
    </ul>
  </div>

  </nav>
  
    <!-- Optional JavaScript , dont put anything after this section-->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>