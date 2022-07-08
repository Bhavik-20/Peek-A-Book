<?php
	session_start();
	if(!isset($_SESSION['admin_id']))
	{
	  header("Location:HomePage_All.php");
	  // $cookie_value=$_SESSION['admin_id'];
	  // setcookie($cookie_name, $cookie_value, time()+60,"/");
	  // setcookie("visiting_user","",time()-3600,"/"); 
	}
	// $HOST="g1ulxzso4stk.us-east-1.psdb.cloud";
	// $USERNAME="7ky85vsj9r7e";
	// $PASSWORD="pscale_pw_MjVZvRR2vGs9XwZNXzvhwoUOgvKEJpB-4hDrwxcauW8";
	// $DATABASE="peek-a-book";
	include "conn.php";
	$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
	if(!$conn)
	{
		echo "Can't connect database " . mysqli_connect_error($conn);
		exit;
	}

	if(isset($_POST['add'])){
		$isbn = trim($_POST['isbn']);
		$isbn = mysqli_real_escape_string($conn, $isbn);
		
		$title = trim($_POST['title']);
		$title = mysqli_real_escape_string($conn, $title);

		$author = trim($_POST['author']);
		$author = mysqli_real_escape_string($conn, $author);
		
		$descr = trim($_POST['descr']);
		$descr = mysqli_real_escape_string($conn, $descr);
		
		$price = floatval(trim($_POST['price']));
		$price = mysqli_real_escape_string($conn, $price);

		$book_qty = intval(trim($_POST['book_qty']));
		$book_qty = mysqli_real_escape_string($conn, $book_qty);
		
		$genre = trim($_POST['genre']);
		$genre = mysqli_real_escape_string($conn, $genre);

		// add image
		if(isset($_FILES['image']) && $_FILES['image']['name'] != "")
		{
			$image = $_FILES['image']['name'];
			$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "uploads/";
			$uploadDirectory .= $image;
			move_uploaded_file($_FILES['image']['tmp_name'], $uploadDirectory);
		}
		else
		{
			echo "fail";
			var_dump($_FILES['image']);
			var_dump($_FILES['image']['name']);
		}

		// find genre and return gid
		// if genre is not in db, create new
		$findGen = "SELECT * FROM genre WHERE genre = '$genre'";
		$findResult = mysqli_query($conn, $findGen);
		$row = mysqli_fetch_assoc($findResult);
		if(is_null($row))
		{
			// insert into publisher table and return id
			$insertGen = "INSERT INTO genre(genre) VALUES ('$genre')";
			$insertResult = mysqli_query($conn, $insertGen);
			if(!$insertResult){
				$err2= mysqli_error($conn);
				echo '<script> alert("Can not add new Genre  '.$err2. '"); </script>';
		}
		$fg = "SELECT * FROM genre WHERE genre = '$genre'";
		$findR = mysqli_query($conn, $fg);
		$r = mysqli_fetch_assoc($findR);
		$genreid = $r['genre_id'];
		} 
		else 
		{
			$genreid = $row['genre_id'];
		}

		//$image = "hdcbh";
		$query = "INSERT INTO books VALUES ('" . $isbn . "', '" . $title . "', '" . $author . "', '" . $image . "', '" . $descr . "', '" . $price . "', '" . $book_qty . "','" . $genreid . "')";
		$result = mysqli_query($conn, $query);
		if(!$result)
		{
			$err=mysqli_error($conn);
			echo '<script> alert("Can not add new data '.$err. '"); </script>';
		} 
		else
		{
			header("Location: Admin_home.php");
			#echo "next page";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Add</title>
    <link rel="stylesheet" type="text/css" href="ContactStyleSheet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font awesome and jQuery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      .goto{
        /* margin: 0px 50px; */
        padding: 10px 40px;
        background-color: #AED6F1;
        border: 2px solid #7FB3D5;
        border-radius: 30px;
        color: darkblue; 
        cursor: pointer;
    }
    </style>
</head>
<body style="background-color:#E3F2FD;">
<?php include "Admin_header.php"?>

<!--<form  method="POST" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> -->
<form method="post" action="Admin_add.php" enctype="multipart/form-data">
        <center>
            <div class="top" style="padding-top:10px;">
                <h1>Add a Book</h1>
            </div>
            <br>
            <div class="box">
            <table class="table">
			<tr>
				<th>ISBN</th>
				<td><input type="text" name="isbn"></td>
			</tr>
			<tr>
				<th>Title</th>
				<td><input type="text" name="title" required></td>
			</tr>
			<tr>
				<th>Author</th>
				<td><input type="text" name="author" required></td>
			</tr>
			<tr>
				<th>Image</th>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<th>Description</th>
				<td><textarea name="descr" cols="40" rows="5"></textarea></td>
			</tr>
			<tr>
				<th>Price</th>
				<td><input type="text" name="price" required></td>
			</tr>
			<tr>
				<th>Quantity</th>
				<td><input type="text" name="book_qty" required></td>
			</tr>
			<tr>
				<th>Genre</th>
				<td><input type="text" name="genre" required></td>
			</tr>
		</table>
		<input type="submit" name="add" class="goto" value="Add new book" class="btn btn-primary">
		<input type="reset" value="cancel" class="goto" >
	</form>
	<br/>
    </div>
    </center>
    </form>
<br><br><br>

<p></p>
<?php include "Footer.php"?>
 
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
</body>

</html>