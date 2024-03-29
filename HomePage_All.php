<?php
$cookie_name="auto_login";
  if(isset($_COOKIE[$cookie_name]))
  {
    header("Location:HomePage_In.php");
  } 
  else
  {
    $cookie_name2="visiting_user";
    $cookie_value="Not logged in user";
    setcookie($cookie_name2, $cookie_value, time()+60,"/");
  } 
  $boxes_checked=[];
 ?>

<!DOCTYPE html>
<html>
<head>
  <title>User Home Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="HomePage_StyleSheet.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- Font awesome and jQuery -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Lobster&display=swap');
    .filter_menu{
      background-color: #D6EAF8;
      padding-left: 50px;
    }
    .filter_heading{
      font-family: 'Lobster', cursive;
      color: #7FB3D5;
      text-shadow: black;
    }

   .filter_set{
    background-color: white;
    border-radius: 20px;
    padding:5px 10px;
    color: #7FB3D5;
    font-style: bold;
    border: 1px solid transparent;
    font-size: 1rem;
    font-weight: 600 ;
    margin-left: 50px;
   }
   
    .carousel {
      height: 250px!important;
    }
    .w-100{
      height: 250px!important;
    }

    .w-100 img{
    max-width:100%;
    height: auto;
    } 
    .fa-heart{
      font-size: 25px;
      color: #FB7769;
      margin-left: 5px;
      transform: scale(1,1);
      }
      .fa-heart-o{
        font-size: 25px;
        margin-left: 5px;
        transform: scale(1,1);
      }

      .block{
      border:1px solid lightgrey;
      border-radius: 10px;
      width: 22%;
      height: 380px;
      margin:5px;
      padding: 5px;
      padding-bottom: 10px;
      cursor: pointer;

      }
      .image_class{
      	max-height: 100%;
      	max-width: 100%;
      	display:"block";
      }

      .hurry{
      background-color: #ffc107;
      color: white;
      display: inline-block;
      font-size: 0.7rem;
      padding: .05rem .3rem;
      margin-left: 10px;
    }
  .outofstock{
      background-color: #E74C3C;
      color: white;
      display: inline-block;
      font-size: 0.7rem;
      padding: .05rem .3rem;
      margin-left: 10px;
  }

    </style>
</head>

<body >
  <!--Navigation Bar-->
 <?php include "Header_All.php";?>
  <!--Navigation Bar Ends-->
   <!-- ==========================Carousel=================================== -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel" style="padding:0px 20px;">
      <ol  class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" height="100%" width="100%" src="images/greatest.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption text-left">
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" height="100%" width="100%" src="images/chetan_bhagat.jpg" alt="Second slide">
          <div class="container">
            
          </div>
        </div>
        <div class="carousel-item">
          <img class="d-block w-100"  height="100%" width="100%" src="images/Book-bg1.jpg" alt="Third slide">
          <div class="container">
            <div class="carousel-caption" style="padding-bottom:60px;">
              <h1>Books are your BestFriend!</h1>
            </div>
          </div>  
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <!-- ---------------------------------------------------------- -->
  
  <div class="main_box" style="padding:20px 0px;">
    <div class="filter_menu">
      <form action="HomePage_All.php" method="post">
        <h2 class="filter_heading">Price Range</h2>
        <br>
        <input type="checkbox" id="eq20" name="price[]" value="<250">
        <label for="under500"> Under ₹250 </label><br>
        <input type="checkbox" id="eq30" name="price[]" value=">251 && book_price<500">
        <label for="eq30"> ₹250-₹500 </label><br>
        <input type="checkbox" id="eq30" name="price[]" value=">499 && book_price<750">
        <label for="eq30"> ₹500-₹750 </label><br>
        <input type="checkbox" id="eq30" name="price[]" value=">749 && book_price<1000">
        <label for="eq30"> ₹750-₹1000 </label><br>
        <input type="checkbox" id="eq30" name="price[]" value=">999 && book_price<1500">
        <label for="eq30"> ₹1000-₹1500 </label><br>
        <input type="checkbox" id="eq30" name="price[]" value=">1499 && book_price<2001">
        <label for="eq30"> ₹1500-₹2000 </label><br>
        <input type="checkbox" id="eq30" name="price[]" value=">2000">
        <label for="eq30"> Above ₹2000 </label><br>
        <br><br>
        <h2 class="filter_heading">Genre</h2>
        <br>
        <!-- checkbox for genres -->
        <?php 
        require "conn.php";
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
            $get_types="SELECT * FROM genre";
            $result = mysqli_query($conn, $get_types);
            for($i = 0; $i < mysqli_num_rows($result); $i++)
            {
              while($row_types = mysqli_fetch_assoc($result))
              {
                ?>
               <input type="checkbox" id="<?php echo $row_types['genre'];?>" name="gen[]" value="<?php echo $row_types['genre_id'];?>">
               <label> <?php echo $row_types['genre']?> </label>
          <br> 
          <?php
              }
              }
            }
            ?> 
    <br>
        <button type="submit" id="filter_set" class="filter_set"  name="filter_set">Confirm</button>
    </form>
    </div>

    <div class="shopping_area" style="float: right; padding:10px">
        <!--Body-->
        <div class="container">
        
        <!-- -------------------------- -->
      <?php 

      $check = 0;
      function getGenreId($conn, $genre){
    $query = "SELECT genre_id FROM genre WHERE genre = '$genre'";
    $result = mysqli_query($conn, $query);
    if(!$result){
      echo "Can't retrieve data " . mysqli_error($conn);
      exit;
    }
    if(mysqli_num_rows($result) == 0){
      echo "Empty books ! Something wrong! check again";
      exit;
    }

    $row = mysqli_fetch_assoc($result);
    return $row['genre_id'];
  }
      
      $type=['null'];
      // $conn = mysqli_connect("localhost", "root", "", "bookstore");
      $conn = mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
      if(!$conn)
      {
        echo "Can't connect database " . mysqli_connect_error($conn);
        exit;
      }
      $get_types="SELECT * FROM genre";
      $result_types = mysqli_query($conn, $get_types);
      for($i = 0; $i < mysqli_num_rows($result_types); $i++)
      {
        while($row_types = mysqli_fetch_assoc($result_types))
        {
          array_push($type,$row_types['genre']);
        }
      }
      $len_type=sizeof($type)-1;
      if(isset($_POST["filter_set"]) || isset($_POST["price"]))
      {
        $set_gen=empty($_POST["gen"]);
        $set_price=empty($_POST["price"]);
        if($set_gen && $set_price)
        {
          $count = 0;
          for($z=1;$z<=$len_type;$z++)
          {
            $query = "SELECT * FROM books where genre_id=$z"; 
            $result = mysqli_query($conn, $query);
            if(!$result)
            {
                echo "Can't retrieve data " . mysqli_error($conn)."<br>";
                exit;
            }
             echo "<p class='subtitle' style='text-align: left;''><font size='5'><b>$type[$z]</b></p></font>";
             for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
             <div class="row">
              <?php while($query_row = mysqli_fetch_assoc($result)){  ?>
                <div class="block">
                  <div style="height: 280px"> 
                  <a href="BookDetails.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
                   <center><div style="height: 180px; width: 150px;">
                      <img class="image_class img-thumbnail" src='uploads/<?php echo $query_row['book_image']; ?>' alt='Image unavailable right now'>
                     </div></center>
                  <p class="name"><?php echo $query_row['book_title']; ?></p>
                  <p class="price">Rs. <?php echo $query_row['book_price']; ?></p>
                  <?php if($query_row['book_qty']==0){ ?>
                    <span class="outofstock">Sorry the item is out of stock</span>
                 <?php } ?>
                  <?php if($query_row['book_qty'] <= 5 && $query_row['book_qty'] != 0) {?>
                    <span class="hurry"> Hurry only <?php echo $query_row['book_qty'] ?> item/s left !!</span>
                 <?php } ?>
               </a>
                </div>
                <div style="position: relative; bottom: 0;">
                  <hr>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-shopping-cart pr-2"></i>Add to cart</button><button type="button" class="btn wishlist" data-toggle="modal" data-target="#exampleModalCenter"><i class="heart fa fa-heart-o" aria-hidden="true"></i></button>
                </div>
               </div>
                <?php
                $count++;
                if($count >= 4)
                {
                    $count = 0;
                    break;
                }
                } //while loop ends here?> 
            </div>
       <?php 
            } //for loop end
            } //for ends
            } //if empty loop ends 

// ------------------------------- Only price filter is given ------------------------------------------------------------ 
          elseif ($set_gen==true && $set_price==false) 
          {
            $wanted_price=array();
            foreach ($_POST["price"] as $value) 
            {
              array_push($wanted_price,$value);
            }
            $price_ids = join(",",$wanted_price);
            $count = 0;
          
            for($z=1;$z<=$len_type;$z++)
            {
              
              foreach($wanted_price as $p)
            {
            $query="SELECT * FROM books where  genre_id=$z && book_price $p";
            $result = mysqli_query($conn, $query);
            if(!$result)
            {
                echo "Can't retrieve data " . mysqli_error($conn)."<br>";
                exit;
            }
            if(mysqli_num_rows($result)!=0){
              $check = 1;
              echo "<p class='subtitle' style='text-align: left;''><font size='5'><b>$type[$z]</b></p></font>";
             for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
             <div class="row">
              <?php while($query_row = mysqli_fetch_assoc($result)){  ?>
                <div class="block">
                  <div style="height: 280px"> 
                  <a href="BookDetails.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
                   <center><div style="height: 180px; width: 150px;">
                      <img class="image_class img-thumbnail" src='uploads/<?php echo $query_row['book_image']; ?>' alt='Image unavailable right now'>
                     </div></center>

                  <p class="name"><?php echo $query_row['book_title']; ?></p>
                  <p class="price">Rs. <?php echo $query_row['book_price']; ?></p>
                  <?php if($query_row['book_qty']==0){ ?>
                  <span class="outofstock">Sorry the item is out of stock</span>
                   <?php } ?>
                   <?php if($query_row['book_qty'] <= 5 && $query_row['book_qty'] != 0) {?>
                     <span class="hurry"> Hurry only <?php echo $query_row['book_qty'] ?> item/s left !!</span>
                <?php } ?>
                  </a>
                </div>
                <div style="position: relative; bottom: 0;">
                  <hr>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-shopping-cart pr-2"></i>Add to cart</button><button type="button" class="btn wishlist" data-toggle="modal" data-target="#exampleModalCenter"><i class="heart fa fa-heart-o" aria-hidden="true"></i></button>
                </div>
               </div>
                <?php
                $count++;
                if($count >= 4)
                {
                    $count = 0;
                    break;
                }
                } //while loop ends here?> 
            </div>
       <?php 
            } //for loop end
            }
          }
            }//for ends
            if ($check ==0)
            {?>
              <div class="filter_heading" style="color:#00A6D7; font-size:70px;">
                Currently
                <img src= 'images/unavailable.jpg'>
              </div>
             <h3 class="filter_heading" style="color:#00A6D7;">Please try some other filters </h3>
              <?php
            }
          } // Only Price Filter 
// -------------------------- Only price filter is given Ends -------------------------------------------

// -------------------------- Only genre filter is given -------------------------------------------------------------  
          elseif ($set_gen==false && $set_price==true) 
          {
            $wanted_genre=array();
            foreach ($_POST["gen"] as $value) 
            {
              array_push($wanted_genre,$value);
            }
            $ids = join(",",$wanted_genre);   
            $count = 0;
            foreach($wanted_genre as $z)
            {
            $query = "SELECT * FROM books where genre_id=$z";
            $result = mysqli_query($conn, $query);
            if(!$result)
            {
                echo "Can't retrieve data " . mysqli_error($conn)."<br>";
                exit;
            }
             echo "<p class='subtitle' style='text-align: left;''><font size='5'><b>$type[$z]</b></p></font>";
             if(mysqli_num_rows($result)!=0){
              $check = 1;
             for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
             <div class="row">
              <?php while($query_row = mysqli_fetch_assoc($result)){  ?>
                <div class="block">
                  <div style="height: 280px"> 
                  <a href="BookDetails.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
                   <center><div style="height: 180px; width: 150px;">
                      <img class="image_class img-thumbnail" src='uploads/<?php echo $query_row['book_image']; ?>' alt='Image unavailable right now'>
                     </div></center>
                  <p class="name"><?php echo $query_row['book_title']; ?></p>
                  <p class="price">Rs. <?php echo $query_row['book_price']; ?></p>
                  <?php if($query_row['book_qty']==0){ ?>
                    <span class="outofstock">Sorry the item is out of stock</span>
                 <?php } ?>
                 <?php if($query_row['book_qty'] <= 5 && $query_row['book_qty'] != 0) {?>
                   <span class="hurry"> Hurry only <?php echo $query_row['book_qty'] ?> item/s left !!</span>
                  <?php } ?>
                  </a>
                </div>
                <div style="position: relative; bottom: 0;">
                  <hr>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-shopping-cart pr-2"></i>Add to cart</button><button type="button" class="btn wishlist" data-toggle="modal" data-target="#exampleModalCenter"><i class="heart fa fa-heart-o" aria-hidden="true"></i></button>
                </div>
               </div>
                <?php
                $count++;
                if($count >= 4)
                {
                    $count = 0;
                    break;
                }
                } //while loop ends here?> 
            </div>
       <?php 
            } //for loop end
          }
            } //for ends
            if ($check ==0)
            {?>
              <div class="filter_heading" style="color:#00A6D7; font-size:70px;">
                Currently
                <img src= 'images/unavailable.jpg'>
              </div>
             <h3 class="filter_heading" style="color:#00A6D7;">Please try some other filters </h3>
              <?php
            }
          } //Only Genre Filter
// ----------------------------------- Only genre filter is given ends-----------------------------------------------------

// -------------------------- Both filters given ---------------------------------------------------------- 
          elseif ($set_gen==false && $set_price==false) 
          {
            $wanted_price=array();
            $wanted_genre=array();
            foreach ($_POST["gen"] as $value) 
            {
              array_push($wanted_genre,$value);
            }
            $genre_ids = join(",",$wanted_genre);

            foreach ($_POST["price"] as $value) 
            {
              array_push($wanted_price,$value);
            }
            $price_ids = join(",",$wanted_price);
            $count = 0;
            
            foreach($wanted_genre as $z)
            { 
              foreach($wanted_price as $p)
              {
            // $query = "SELECT * FROM books where book_price IN ('.$price_ids.')"; 
              $query="SELECT * FROM books where genre_id=$z && book_price $p";
            $result = mysqli_query($conn, $query);
            if(!$result)
            {
                echo "Can't retrieve data " . mysqli_error($conn)."<br>";
                exit;
            }
             echo "<p class='subtitle' style='text-align: left;''><font size='5'><b>$type[$z]</b></p></font>";
             if(mysqli_num_rows($result)!=0){
              $check = 1;
             for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
             <div class="row">
              <?php while($query_row = mysqli_fetch_assoc($result)){  ?>
                <div class="block">
                  <div style="height: 280px"> 
                  <a href="BookDetails.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
                   <center><div style="height: 180px; width: 150px;">
                      <img class="image_class img-thumbnail" src='uploads/<?php echo $query_row['book_image']; ?>' alt='Image unavailable right now'>
                     </div></center>
                  <p class="name"><?php echo $query_row['book_title']; ?></p>
                  <p class="price">Rs. <?php echo $query_row['book_price']; ?></p>
                  <?php if($query_row['book_qty']==0){ ?>
                    <span class="outofstock">Sorry the item is out of stock</span>
                      <?php } ?>
                   <?php if($query_row['book_qty'] <= 5 && $query_row['book_qty'] != 0) {?>
                   <span class="hurry"> Hurry only <?php echo $query_row['book_qty'] ?> item/s left !!</span>
              <?php } ?>
                  </a>
                </div>
                <div style="position: relative; bottom: 0;">
                  <hr>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-shopping-cart pr-2"></i>Add to cart</button><button type="button" class="btn wishlist" data-toggle="modal" data-target="#exampleModalCenter"><i class="heart fa fa-heart-o" aria-hidden="true"></i></button>
                </div>
               </div>
                <?php
                $count++;
                if($count >= 4)
                {
                    $count = 0;
                    break;
                }
                } //while loop ends here?> 
            </div>
       <?php 
            } //for loop end
          }
            } // price for ends
          } //genre for ends
           if ($check ==0)
            {?>
              <div class="filter_heading" style="color:#00A6D7; font-size:70px;">
                Currently
                <img src= 'images/unavailable.jpg'>
              </div>
             <h3 class="filter_heading" style="color:#00A6D7;">Please try some other filters </h3>
              <?php
            }
          } // Both filters given 
// ------------------------------------- Both filters given ends --------------------------------------------------------
          } // isset post for gen and price ends

    // main else loop : On start when no post is set    
      else
      {
      $count = 0;
      for($z=1;$z<=$len_type;$z++)
      {
        $gid = getGenreId($conn,$type[$z]);
      $query = "SELECT * FROM books where genre_id=$z"; 
      $result = mysqli_query($conn, $query);
        if(!$result)
        {
            echo "Can't retrieve data " . mysqli_error($conn)."<br>";
            exit;
        } 
       
       if(mysqli_num_rows($result)!=0){
      echo "<p class='subtitle' style='text-align: left;''><font size='5'><b>$type[$z]</b></p></font>";
       for($i = 0; $i < mysqli_num_rows($result); $i++){ ?>
        <div class="row">
          <?php while($query_row = mysqli_fetch_assoc($result)){  ?>
            <div class="block">
            	<div style="height: 280px">	
            	<a href="BookDetails.php?bookisbn=<?php echo $query_row['book_isbn']; ?>">
               <center><div style="height: 180px; width: 150px;">
                	<img class="image_class img-thumbnail" src='uploads/<?php echo $query_row['book_image']; ?>' alt='Image unavailable right now'>
                 </div></center>
              <p class="name"><?php echo $query_row['book_title']; ?></p>
              <p class="price">Rs. <?php echo $query_row['book_price']; ?></p>
              <?php if($query_row['book_qty']==0){ ?>
                <span class="outofstock">Sorry the item is out of stock</span>
              <?php } ?>
              <?php if($query_row['book_qty'] <= 5 && $query_row['book_qty'] != 0) {?>
            <span class="hurry"> Hurry only <?php echo $query_row['book_qty'] ?> item/s left !!</span>
          <?php } ?>
              </a>
            </div>
            <div style="position: relative; bottom: 0;">
            	<hr>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-shopping-cart pr-2"></i>Add to cart</button><button type="button" class="btn wishlist" data-toggle="modal" data-target="#exampleModalCenter"><i class="heart fa fa-heart-o" aria-hidden="true"></i></button>
            </div>
        </div>
            <?php
            
            } //while loop ends here?> 
        </div>
       <?php 
            } //for loop end
          }//ending if condition ehich checks if genre has any books
          } //main for ends
        } // main else loop : On start when no post is set
       ?>    
 </div>
</div>
</div>  
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
    $(".heart.fa").click(function() {
        $(this).toggleClass("fa-heart fa-heart-o");
    });

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

	<?php require 'Footer.php'; ?>
	<!-- Optional JavaScript , dont put anything after this section-->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>