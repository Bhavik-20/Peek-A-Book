<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,600&display=swap');
		.headings{
			font-family: 'Playfair Display', serif;
		}

		.box{
			margin: 30px; 
			padding:20px; 
			border: 2px solid lightgrey; 
			border-radius: 10px;
		}
		.new-btn{
			background-color: #ffc107;
			color: white;
			display: inline-block;
    		font-weight: 400;
    		text-align: center;
    		vertical-align: middle;
		    padding: .375rem .75rem;
		    font-size: 1rem;
		    line-height: 1.5;
		    border-radius: 5px;
		    border: none;
		}

		.new-btn:hover{
			text-decoration: none;
			opacity: 0.7;
			color: white;
		}
	</style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <?php 	
 session_start();
include "Header_file.php";
include "Cart_functions.php";

	
  if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart'])))
  {
?>
<div class="box">
	<h3 class="headings"> Invoice: </h3>
	<table class="table">
		<tr>
			<th>Item</th>
			<th>Price</th>
	    	<th>Quantity</th>
	    	<th>Total</th>
	    </tr>
	    	<?php
				require "conn.php";
			    foreach($_SESSION['cart'] as $isbn => $qty)
			    {
					// $conn =  mysqli_connect("localhost", "root", "", "bookstore");
					$conn = mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
				    if(!$conn)
				    {
				      echo "Can't connect database " . mysqli_connect_error($conn);
				      exit;
				    }
					$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			?>
		<tr>
			<td>
			<?php 
				echo '<img style="margin-right:10px;" src="uploads/'.$book['book_image'].'" height=50, width=50>';
				echo $book['book_title'] . " by " . $book['book_author']; 
			?>
			</td>
			<td><?php echo "Rs. " . $book['book_price']; ?></td>
			<td><?php echo $qty; ?></td>
			<td><?php echo "Rs. " . $qty * $book['book_price']; ?></td>
		</tr>
		<?php } //foreach ends here ?>
		<tr>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th><?php echo $_SESSION['total_items']; ?></th>
			<th><?php echo "Rs. " . $_SESSION['total_price']; ?></th>
		</tr>
	</table>
</div>
<?php 
	
	} //if condition ends here
	
?>

<div class="box">
	 <h3 class="headings"> Shipping Address </h3>
	 <hr>
	 <h5>The order will be delivered to:</h5> 
	 <?php
	//  $conn =  mysqli_connect("localhost", "root", "", "bookstore");
	$conn = mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
    if(!$conn)
    {
      echo "Can't connect database " . mysqli_connect_error($conn);
      exit;
    }
	 $id=$_SESSION['user_id'];
	 $query="select * from users where id=$id";
	 $result = mysqli_query($conn, $query);
	 $query_row = mysqli_fetch_assoc($result);
	 echo "<p> Address: ".$query_row['address_1']."</p>";
	 echo "<p>City: ".$query_row['city']."</p>";
	 echo "<p>State: ".$query_row['state']."</p>";
	 echo "<p>Zip Code: ".$query_row['zip']."</p>";
	?>
	<h6> Note: If you want to change the address for delivery, please update your address in User profile before confirming the oreder.</h6>
</div>
<script>
	function alert_func()
	{
		var r = confirm("Are you sure you want to Confirm this order? You may cancel and continue shopping.");
		if (r == true) 
		{
		  <?php 
		  	$_SESSION['empty_cart']="empty_cart";
		   	?>
		  window.location.href = "Thankyou_Message.php";
		}
	}
</script> 
<div class="box">
	<h3 class="headings" > Payement Method:</h3>
	<hr>
	<p> We only have cash on delivery mode for now. </p>
	<p> Total amount to be payed:<b> <?php echo "Rs. " . $_SESSION['total_price']; ?> </b></p>
	 <p> The order will be shipped to you in 2-3 days, we have absolutely free shipping ! </p>
	</div>
	<form method="POST" action= "Thankyou_Message.php">
	<center>
	<button type="submit" class="new-btn" onclick="alert_func()" >Confirm</button>
	<!-- <a href="#" class="new-btn" onclick="alert_func()">Confirm</a> -->
 	</center>
	</form>
	<br>

</body>

<footer>
<?php 
	require_once "Footer.php"; 
?>

</footer>
</html>