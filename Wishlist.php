<!DOCTYPE html>
<html>
<head>
	<title>Book Store Wishlist</title>
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

		.hurry{
			background-color: #ffc107;
			color: white;
			display: inline-block;
			font-size: 0.7rem;
			padding: .05rem .3rem;
			margin-left: 10px;
		}

	
	</style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php  
		session_start();
	require_once "Cart_functions.php";
	include "Header_file.php";

if(isset($_GET['bookisbn'])){
		$book_isbn = $_GET['bookisbn'];
	}

	$conn = mysqli_connect("localhost", "root", "", "bookstore");
	  if (!$conn) 
	  {
	    die("Connection failed: " . mysqli_connect_error());
	  }
	 $id=$_SESSION['user_id'];
	 $query = "SELECT wishlist FROM users WHERE id = $id";
	 $result = mysqli_query($conn, $query);
	 $book = mysqli_fetch_assoc($result);
	 if(is_null($book['wishlist']))
	 {
	 	$_SESSION['wishlist'] = array();
	 }
	 else
	 {
	 	$_SESSION['wishlist'] = unserialize($book['wishlist']);
	}

	if(isset($book_isbn)){
		// new iem selected
		if(!isset($_SESSION['wishlist'])){
			// $_SESSION['cart'] is associative array that has bookisbn => qty
			$_SESSION['wishlist'] = array();
		}

		if(!isset($_SESSION['wishlist'][$book_isbn])){
			$_SESSION['wishlist'][$book_isbn] = 1;
		} elseif(isset($_POST['wishlist'])){
			$_SESSION['wishlist'][$book_isbn]++;
			unset($_POST);
		}
	}

		// if delete  button is clicked , change the qty of each bookisbn to 0
	if(isset($_POST['del_book']))
	{
		$del_isbn=$_POST['del_book'];
		
		//$_SESSION['cart']["$del_isbn"] = 0; // $_POST["$isbn"] this is the qty entered in the form below
		unset($_SESSION['wishlist']["$del_isbn"]);

		    $conn = mysqli_connect("localhost", "root", "", "bookstore");
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


	if(isset($_SESSION['wishlist']) && (array_count_values($_SESSION['wishlist'])))
	{
		 $conn = mysqli_connect("localhost", "root", "", "bookstore");
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
?>

<body>
	<h2 class="headings"> Wishlist </h2>
   		<div style="margin: 30px; padding:20px; border: 2px solid lightgrey; border-radius: 10px;">
	   	<table class="table">
	   		<tr>
	   			<th>Item</th>
	   			<th>Price</th>
	  			<th>Add to Cart </th>
	   			<th>Remove from Wishlist </th>	
	   		</tr>
	   		<?php
		    	foreach($_SESSION['wishlist'] as $isbn => $qty){
					$conn = mysqli_connect("localhost", "root", "", "bookstore");
				    if(!$conn){
				      echo "Can't connect database " . mysqli_connect_error($conn);
				      exit;
				    }
					$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
			?>
			<tr>
				<td> 
					<?php 
					if ($book['book_qty'] == 0){
					echo '<img style="margin-right:10px;" src="uploads/'.$book['book_image'].'" height=50, width=50>';
					echo $book['book_title'] . " by " . $book['book_author'] . " <span class='hurry'> Out of Stock </span>";
				} else {
					echo '<img style="margin-right:10px;" src="uploads/'.$book['book_image'].'" height=50, width=50>';
					echo $book['book_title'] . " by " . $book['book_author'];
				}
					 ?>
				</td>
				<td><?php echo "Rs. " . $book['book_price']; ?></td>
				<td>	
				<form action="Cart.php" method="post">
				<input type="hidden" name="add_to_cart" value="<?php echo $isbn;?>">
				<?php if ($book['book_qty'] == 0){ ?>
				<button type="submit"class="trash" disabled>
				<i class="fa fa-shopping-cart" style="color: #ccc;"></i> 
				</button>
				<?php } else { ?>
				<button type="submit"class="trash">
				<i class="fa fa-shopping-cart" style="color: #ffc107"></i> 
				</button>
				<?php } ?>
			    </form> </td>
				<form action="Wishlist.php" method="post">
				<td><button type="submit" name="del_book" class="trash" value="<?php echo $isbn?>"><i class="fa fa-trash"></i>
				</button></form></td>
				
			</tr>
			
			<?php 
				} //Foreach bracket ending			
			?>
	   	</table>
	   <a href="HomePage_In.php" class="new-btn">Continue Shopping</a>
	</form>
</div>
<?php
	} 
	else 
		{ ?>
		<center> <div>
		<br><br> 
		<img src="images/emptywishlist.png" />
		<br> 
	    <a href="HomePage_In.php" class="new-btn">Continue Shopping</a>
	    </div></center>
	    <br>
	<?php
	}
?>
<script type="text/javascript">
	function remove(){
		<?php 
			$_SESSION['remove'] = 'remove';
		?>
	}
</script>
</body>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<?php require_once "footer.php"; ?>

</html>