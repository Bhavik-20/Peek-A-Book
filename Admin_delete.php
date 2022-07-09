<?php
	require "conn.php";
	$book_isbn = $_GET['bookisbn'];

	// $conn = mysqli_connect("localhost", "root", "", "bookstore");
	$conn = mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
		if(!$conn){
			echo "Can't connect database " . mysqli_connect_error($conn);
			exit;
		}

	$query = "DELETE FROM books WHERE book_isbn = '$book_isbn'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "delete data unsuccessfully " . mysqli_error($conn);
		exit;
	}
	header("Location: Admin_home.php");
?>