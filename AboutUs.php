<?php 
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Peek-A-Book | About Us Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- Font awesome and jQuery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Lobster&display=swap');
        .contain {
           width:100%;
           height: 225px;
           position: relative;
            font-family: 'Lobster', cursive;
		}
		.navbar-brand h1{
  			display: inline;
  			font-size: x-large;
  			font-family: 'Lobster', cursive;
		}
        .contain img{
           width:100%;
           height: 225px;
        }
       
        .text-block {
        position: absolute;
        bottom: 5px;
        left: 20px;
        background-color: black;
        opacity: 0.8;
        color: white;
        padding: 10px 20px;
        }
        .text-block h1{
            font-size: 60px;
        }

        .box{
            background-color: white; 
            margin: 15px; 
            width:30%;
            padding: 10px;
            height: fit-content;
            box-shadow: 1px 1px 1px 1px lightslategray ;
            border-radius: 15px;
            border: lightslategray;
        }

        .icon{
            margin:auto; 
            height:60px; 
            width:60px; 
            padding-top:20px;
            
        }

        .content{
            padding: 40px 30px 20px 30px;
            text-align: center;
        }
        .box2{
            background-color: white; 
            margin: 15px; 
            width:30%;
            padding: 10px;
            height: fit-content;
            border-radius: 15px;
            border: 0.25px solid #EAEDED;
        }
        .container-2{
            background-color:white; 
            height: 450px;
            width:100% ;
            padding: 5% 10%;
        }

   
    </style>
</head>
<body style="background-color:#E3F2FD;">
<?php 
  //if(!is_null($_SESSION['user_id']))
  if(isset($_SESSION['user_id']))
  {
    include "Header_file.php";
  }
  else
  {
    include "Header_All.php";
  }
?>
<div class="contain" style="height: 150px, width:100%;">
        <img src="images/top_img.jpg" alt="Image">
        <div class="text-block">
            <h1>About Us</h1>
  </div>
</div>
<br>
  <div class="container" style="width:70%">
        <br>
        <div class="row" >
          <div class="box" >
           <div class="icon">
                <img src="images/book-open-solid.svg" height=60px; width=60px; />
           </div>
           <div class="content"> 
                <p> We provide an environment where you are recommended the books best suited for you. </p>
           </div>
          </div>
          <div class="box" >
           <div class="icon">
                <img src="images/graduation-cap-solid.svg" height=60px; width=60px; />
           </div>
           <div class="content"> 
                <p>Learning should be affordable for everyone, we provide students with special discounts. </p>
           </div>
          </div>
          <div class="box" >
           <div class="icon">
                <img src="images/magic-solid.svg" height=60px; width=60px; />
           </div>
           <div class="content"> 
                <p>We do believe that reading a book can be a magic portal to a world of imagination.</p>
           </div>
          </div>     
    <br><br>
        </div>
</div>
    </div>
<br><br><br>
<div class="container-2" >
    <div class="row" style="padding-left: 40px;">
        <div style="width:30%;">
            <center><img src="images/bb1.jpg" height=200px; width=200px; style="border-radius: 50% ;border: 7px solid #CCD1D1;"/></center>
            <div class="content" style="text-align: center;padding-top:0px; padding-bottom: 5px;"> 
                <h5 style="padding-top: 20px;"> Bhavik Bhatt </h5>
                <h6> 1814007 </h6>
                <p> Age: 22</p>
           </div>
        </div>
        <div style="width:30%;">
            <center><img src="images/muskaan.JPG" height=200px; width=200px; style="border-radius: 50% ;border: 7px solid #CCD1D1;"/></center>
            <div class="content" style="text-align: center;padding-top:0px; padding-bottom: 5px;"> 
                <h5 style="padding-top: 20px;"> Muskaan Nandu </h5>
                <h6> <a href="https://www.linkedin.com/" class="fa fa-linkedin"> Muskaan Nandu </a></h6>
                <p> Age: 22</p>
           </div>
        </div>
        <div style="padding-top:60px; margin-left:40px; width: 30%">
            <img src="images/Book-bg5.jpg" style=" border-radius:20px;"/>
        </div>
    </div>
</div>
<p></p>
<?php include "Footer.php"?>
 
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
</body>

</html>