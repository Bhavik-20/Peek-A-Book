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
    <a class="navbar-brand" href="Admin_home.php"><h1>Book Store</h1></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item">
        <a class="nav-link" href="Admin_home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="Admin_add.php">Add Books</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="Admin_orders.php">Orders</a>
      </li>
    </ul>
    </div>
    <!-- Search form -->
		<div class="input-group-prepend" >
			<span class="input-group-text cyan lighten-2" id="basic-text1" style="height: 25px;"><i class="fa fa-search text-black" aria-hidden="true"></i></span>
		
		<!-- <input class="form-control my-0 py-1" type="text" placeholder="Search" aria-label="Search" > -->
    <?php include "SearchTry.php" ?>
	</div>
	<br><br>
	<!-- Search form ends -->
    <ul class="navbar-nav" style="float: right; color:white;">
      <li>
        <a class="nav-link " href="SigningOut.php" style="float: right; color:white;"> Sign Out</a>
        <?php 
          $_SESSION['admin_sign_out']='true';
        ?>
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