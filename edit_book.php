<?php	
	// if save change happen
	if(!isset($_POST['save_change'])){
		echo "Something wrong!";
		exit;
	}

	$isbn = trim($_POST['isbn']);
	$title = trim($_POST['title']);
	$author = trim($_POST['author']);
	$descr = trim($_POST['descr']);
	$price = floatval(trim($_POST['price']));
	$qty = intval(trim($_POST['qty']));
	$genre = trim($_POST['genre']);

	if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){
		$image = $_FILES['image']['name'];
		$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
		$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "uploads/";
		$uploadDirectory .= $image;
		move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
	}

	// $conn = mysqli_connect("localhost", "root", "", "bookstore");
	include "conn.php";
	$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);

		if(!$conn){
			echo "Can't connect database " . mysqli_connect_error($conn);
			exit;
		}

	// if publisher is not in db, create new
	$findGen = "SELECT * FROM genre WHERE genre = '$genre'";
	$findResult = mysqli_query($conn, $findGen);
	if(!$findResult){
		// insert into publisher table and return id
		$insertGen = "INSERT INTO genre(genre) VALUES ('$genre')";
		$insertResult = mysqli_query($conn, $insertGen);
		if(!$insertResult){
			echo "Can't add new publisher " . mysqli_error($conn);
			exit;
		}
	}


	$query = "UPDATE books SET  
	book_title = '$title', 
	book_author = '$author', 
	book_desc = '$descr', 
	book_price = '$price',
	book_qty = '$qty'";
	if(isset($image)){
		$query .= ", book_image='$image' WHERE book_isbn = '$isbn'";
	} else {
		$query .= " WHERE book_isbn = '$isbn'";
	}
	// two cases for fie , if file submit is on => change a lot
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't update data " . mysqli_error($conn);
		exit;
	} else {
		header("Location: admin_edit.php?bookisbn=$isbn");
	}
?>