<!DOCTYPE html>
<html>
<head>
	<title>Book Store Cart Page</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,600&display=swap');
		.headings{
			padding-top: 20px;
			padding-left: 10px;
			font-family: 'Playfair Display', serif;
		}

		.trash{
			background-color: white;
			border: none;
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
		    border-radius: .25rem;
		}

		.new-btn:hover{
			text-decoration: none;
			opacity: 0.7;
			color: white;
		}

	
	</style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php
	// the shopping cart needs sessions, to start one
	/*
		Array of session(
			cart => array (
				book_isbn (get from $_POST['book_isbn']) => number of books
			),
			items => 0,
			total_price => '0.00'
		)
	*/

	session_start();
	require_once "Cart_functions.php";
	include "Header_file.php";
	include "conn.php";

	// book_isbn got from form post method, change this place later.
	if(isset($_POST['bookisbn'])){
		$book_isbn = $_POST['bookisbn'];
	}

    if(isset($_POST['add_to_cart']))
	{
		$book_isbn = $_POST['add_to_cart'];
		$del_isbn=$_POST['add_to_cart'];

		unset($_SESSION['wishlist']["$del_isbn"]);

		    // $conn = mysqli_connect("localhost", "root", "", "bookstore");
			$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);

	          if (!$conn) 
	          {
	            die("Connection failed: " . mysqli_connect_error());
	          }
		     $wishlist_array = serialize($_SESSION['wishlist']);
		     $id=$_SESSION['user_id'];
		     $query = "UPDATE users SET wishlist=? WHERE id=?";
		     $pst = mysqli_prepare($conn,$query);
		     mysqli_stmt_bind_param($pst,"si",$wishlist_array,$id);
		     mysqli_stmt_execute($pst);
		     mysqli_stmt_close($pst);
	}

	// $conn = mysqli_connect("localhost", "root", "", "bookstore");
	$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);

	  if (!$conn) 
	  {
	    die("Connection failed: " . mysqli_connect_error());
	  }
	 $id=$_SESSION['user_id'];
	 $query = "SELECT cart FROM users WHERE id = $id";
	 $result = mysqli_query($conn, $query);
	 $book = mysqli_fetch_assoc($result);
	 if(is_null($book['cart']))
	 {
	 	$_SESSION['cart'] = array();
	 }
	 else
	 {
	 	$_SESSION['cart'] = unserialize($book['cart']);
	}

	if(isset($book_isbn)){
		// new iem selected
		if(!isset($_SESSION['cart'])){
			// $_SESSION['cart'] is associative array that has bookisbn => qty
			$_SESSION['cart'] = array();

			$_SESSION['total_items'] = 0;
			$_SESSION['total_price'] = '0.00';
		}

		if(!isset($_SESSION['cart'][$book_isbn])){
			$_SESSION['cart'][$book_isbn] = 1;
		} elseif(isset($_POST['cart'])){
			$_SESSION['cart'][$book_isbn]++;
			unset($_POST);
		}
	}

	// if save change button is clicked , change the qty of each bookisbn
	if(isset($_POST['save_change'])){
		foreach($_SESSION['cart'] as $isbn =>$qty){
			if($_POST[$isbn] == '0'){
				unset($_SESSION['cart']["$isbn"]);
			} else {
				$_SESSION['cart']["$isbn"] = $_POST["$isbn"]; // $_POST["$isbn"] this is the qty entered in the form below
			}
		}
		    // $conn = mysqli_connect("localhost", "root", "", "bookstore");
			$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);

	          if (!$conn) 
	          {
	            die("Connection failed: " . mysqli_connect_error());
	          }
		     $cart_array = serialize($_SESSION['cart']);
		     $id=$_SESSION['user_id'];
		     $query = "UPDATE users SET cart=? WHERE id=?";
		     $pst = mysqli_prepare($conn,$query);
		     mysqli_stmt_bind_param($pst,"si",$cart_array,$id);
		     mysqli_stmt_execute($pst);
		     mysqli_stmt_close($pst);
	}

		// if delete  button is clicked , change the qty of each bookisbn to 0
	if(isset($_POST['del_book']))
	{
		$del_isbn=$_POST['del_book'];
		
		//$_SESSION['cart']["$del_isbn"] = 0; // $_POST["$isbn"] this is the qty entered in the form below
		unset($_SESSION['cart']["$del_isbn"]);

		    // $conn = mysqli_connect("localhost", "root", "", "bookstore");
			$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);

	          if (!$conn) 
	          {
	            die("Connection failed: " . mysqli_connect_error());
	          }
		     $cart_array = serialize($_SESSION['cart']);
		     $id=$_SESSION['user_id'];
		     $query = "UPDATE users SET cart=? WHERE id=?";
		     $pst = mysqli_prepare($conn,$query);
		     mysqli_stmt_bind_param($pst,"si",$cart_array,$id);
		     mysqli_stmt_execute($pst);
		     mysqli_stmt_close($pst);

	}

	if(isset($_SESSION['cart']) && (array_count_values($_SESSION['cart'])))
	{
		$_SESSION['total_price'] = total_price($_SESSION['cart']);
		$_SESSION['total_items'] = total_items($_SESSION['cart']);
		//  $conn = mysqli_connect("localhost", "root", "", "bookstore");
		$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);

	          if (!$conn) 
	          {
	            die("Connection failed: " . mysqli_connect_error());
	          }
	     $cart_array = serialize($_SESSION['cart']);
	     $id=$_SESSION['user_id'];
	     $query = "UPDATE users SET cart=? WHERE id=?";
	     $pst = mysqli_prepare($conn,$query);
	     mysqli_stmt_bind_param($pst,"si",$cart_array,$id);
	     mysqli_stmt_execute($pst);
	     mysqli_stmt_close($pst);
?>

<body>
	<h2 class="headings">Your Cart </h2>
   	<form action="Cart.php" method="post">
   		<div style="margin: 30px; padding:20px; border: 2px solid lightgrey; border-radius: 10px;">
	   	<table class="table">
	   		<tr>
	   			<th>Item</th>
	   			<th>Price</th>
	  			<th>Quantity</th>
	   			<th>Total</th>
	   			<th> </th>
	   		</tr>
	   		<?php
		    	foreach($_SESSION['cart'] as $isbn => $qty){
					// $conn = mysqli_connect("localhost", "root", "", "bookstore");
					$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);

				    if(!$conn){
				      echo "Can't connect database " . mysqli_connect_error($conn);
				      exit;
				    }
					$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			?>
			<tr>
				<td> 
					<?php echo '<img style="margin-right:10px;" src="uploads/'.$book['book_image'].'" height=50, width=50>';
					echo $book['book_title'] . " by " . $book['book_author']; ?>
				</td>
				<td><?php echo "Rs. " . $book['book_price']; ?></td>
				<td><input type="number" value="<?php echo $qty; ?>" size="2" name="<?php echo $isbn; ?>" min = "1" max = "<?php echo $book['book_qty']?>"></td>
				<td><?php echo "Rs. " . $qty * $book['book_price']; ?></td>
				
				<td><button type="submit" name="del_book" class="trash" value="<?php echo $isbn?>"><i class="fa fa-trash"></i></button></td>
			</tr>
			
			<?php 
				} //Foreach bracket ending			
			?>
		    <tr>
		    	<th>&nbsp;</th>
		    	<th>&nbsp;</th>
		    	<th><?php echo $_SESSION['total_items']; ?></th>
		    	<th><?php echo "Rs. " . $_SESSION['total_price']; ?></th>
		    	<th>&nbsp;</th>
		    </tr>
	   	</table>
	   	<input type="submit" class="btn btn-primary" name="save_change" value="Save Changes">
	</form>



	<br><br>
	<a href="HomePage_In.php" class="btn btn-primary">Continue Shopping</a>
	<a href="Checkout.php" class="new-btn" >Checkout</a>
	<!-- <script>
		function alert_func(){
			var r = confirm("Are you sure you want to Proceed to checkout? You may cancel and continue shopping.");
			if (r == true) {
			  window.location = "Checkout.php";
			}
		}
	</script>  -->
<?php
	} 
	else 
		{ ?>
		<center> <div> 
		<img src="images/emptycart.png" />
		<p class="text-warning">Your cart is empty! Please make sure you add some books in it!</p>
		<br> 
	    <a href="HomePage_In.php" class="new-btn">Continue Shopping</a>
	    </div></center>
	    
	<?php
	}
?>
</div>
	<br/>
</body>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<footer>

<?php 
	require_once "footer.php"; ?>
</footer>
</html>