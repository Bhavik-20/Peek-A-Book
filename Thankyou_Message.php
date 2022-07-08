<!DOCTYPE html>
<html>
<head>
	<title>Checkout</title>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,600&display=swap');
		@import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');
		.headings{
			font-family: 'Pacifico', cursive;
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
	//include "Header_file.php";

	function getOrderId($conn, $customerid){
		// $conn = mysqli_connect("localhost", "root", "", "bookstore");
		include "conn.php";
		$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
		$query = "SELECT orderid FROM orders WHERE userid = '$customerid' and date = date('Y-m-d H:i'); ";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "retrieve data failed!" . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['orderid'];
	}
	function getbookprice($isbn){
		include "conn.php";
		$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
		// $conn = mysqli_connect("localhost", "root", "", "bookstore");
		$query = "SELECT book_price FROM books WHERE book_isbn = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "get book price failed! " . mysqli_error($conn);
			exit;
		}
		$row = mysqli_fetch_assoc($result);
		return $row['book_price'];
	}

	function getBookByIsbn($conn, $isbn){
		$query = "SELECT book_title, book_author, book_price , book_image, book_qty FROM books WHERE book_isbn = '$isbn'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
		return $result;
	}

	//update items left
	foreach($_SESSION['cart'] as $isbn => $qty)
	   {
		include "conn.php";
		$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
	   	// $conn = mysqli_connect("localhost", "root", "", "bookstore");
		if (!$conn) 
		{
		die("Connection failed: " . mysqli_connect_error());
		}
	   	$book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
	   	$items_left = $book['book_qty']- $qty;
	   	// echo $isbn;
	   	// echo $items_left;
	   	$newquery = "UPDATE books SET book_qty=? WHERE book_isbn=?";
	   	$pstnew = mysqli_prepare($conn,$newquery);
	   	mysqli_stmt_bind_param($pstnew,"ii",$items_left,$isbn);
	   	mysqli_stmt_execute($pstnew);
	   	mysqli_stmt_close($pstnew);
	   }
			
	if(isset($_SESSION['empty_cart']))
	{

		// $conn = mysqli_connect("localhost", "root", "", "bookstore");
		include "conn.php";
		$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
		if (!$conn) 
		{
		die("Connection failed: " . mysqli_connect_error());
		}
		// add in orers table
		$id=$_SESSION['user_id'];
		$date = date("Y-m-d H:i");
		$cart= serialize($_SESSION['cart']);
		$query=$query = "INSERT INTO orders VALUES 
		('', '" . $id . "', '" . $_SESSION['total_price'] . "', '" . $date . "', '" . $cart . "')";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Insert orders failed " . mysqli_error($conn);
			exit;
		}
		// insert in order items

		// ------------Empty Cart-----------------
		$query2 = "UPDATE users SET cart=NULL WHERE id=?";
		$pst = mysqli_prepare($conn,$query2);
		mysqli_stmt_bind_param($pst,"i",$id);
		mysqli_stmt_execute($pst);
		mysqli_stmt_close($pst);
		unset($_SESSION['empty_cart']);	
		echo "<br><br>
		<center> <h1 class='headings' style='font-size:150px'>Thank You </h1><br><br><br>
		<h1  class='headings'> For Shopping with us, Your Item Will be delivered to you soon.</h1>
		<br><br><br><a href='HomePage_In.php' class='new-btn'>Go Back to Shopping</a><br><br><br></center>";
		echo "<script>setTimeout(\"location.href = 'HomePage_In.php';\",3000);</script>";
	}
	else
	{
		if(isset($_SESSION['user_id']))
		{
			include "Header_file.php";
		}
		else
		{
			include "Header_All.php";
		}
		echo "<h1></h1><br><br><br>
		<center> <h1 class='headings' style='font-size:150px'>Thank You </h1><br><br><br>
		<h1  class='headings'> For your feedback, we will contact you via e-mail soon.</h1>
		<br><br><br><a href='HomePage_In.php' class='new-btn'>Go Back to Shopping</a><br><br><br></center>";
		require_once "footer.php"; 
		
	}		
?>

<!-- <h1></h1>
<br><br><br><br><br><br><br>
<h1 class="headings">Thank You  For Shopping with us, Your Item Will be delivered to you soon.</h1>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

<!-- <footer>
	<?php ?>
</footer> -->

</html>