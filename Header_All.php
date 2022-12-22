<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap CSS -->
  <link rel="icon" href="data:,">
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
    <a class="navbar-brand" href="HomePage_All.php"><h1>Peek-A-Book</h1></a>
      
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0" >  
        <li class="nav-item active">
          <a class="nav-link" style="color:white;" href="HomePage_All.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" style="color:white;" href="ContactUs.php">Contact Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " style="color:white;" href="AboutUs.php">About Us</a>
        </li>
      </ul>

    <!-- Search form -->
      <div class="input-group-prepend" >
        <span class="input-group-text cyan lighten-2" id="basic-text1" style="height: 25px;"><i class="fa fa-search text-black" aria-hidden="true"></i></span>
      </div>
      <!-- <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search" > -->
      <?php 
      include "SearchTry.php" 
      ?>
      <br><br>
    <!-- Search form ends -->
      <ul class="navbar-nav"  style="float: right;margin-left:10px;">
        <li class="nav-item left_bord">
          <a class="nav-link" style="color:white;" href="SignIn.php">Sign In </a> 
        </li>
        <li></li>
        <li class="nav-item ">
          <a class="nav-link" style="color:white;" href="SignUp.php">Sign Up</a>
        </li>
      <li>
        <a class="nav-link " style="color:white;" href="Cart.php" data-toggle="modal" data-target="#exampleModalCenter" ><span> <svg width="2em" height="2em" viewBox="0 0 16 16" class="bi bi-cart4" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
        </svg>
        </span>
        </a>
      </li>
    </ul>
  </nav>

  <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body" style= "text-align: justify; padding: 20px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                Hello Stranger ! 
                <br> Please Sign Up / Sign In to access add to cart or wishlist.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="Redirect(1)">Sign Up</button>
                <button type="button" class="btn btn-primary" onclick="Redirect(2)">Sign In</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

        <script>
           function Redirect(x)
    {
      if(x==1)
      {
        location.href = "SignUp.php";
      }

      if(x==2)
      {
        location.href = "SignIn.php";
      }
    }
  </script>
        </script>
  
    <!-- Optional JavaScript , dont put anything after this section-->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>