<?php 
session_start();
if(!isset($_SESSION['admin_id']))
{
  header("Location:HomePage_All.php");
  // $cookie_value=$_SESSION['admin_id'];
  // setcookie($cookie_name, $cookie_value, time()+60,"/");
  // setcookie("visiting_user","",time()-3600,"/"); 
}

 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Edit</title>
    <link rel="stylesheet" type="text/css" href="ContactStyleSheet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font awesome and jQuery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      .goto{
        /* margin: 0px 50px; */
        padding: 5px 20px;
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

<?php 
	require "conn.php";
	// $conn = mysqli_connect("localhost", "root", "", "bookstore");
	$conn = mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
		if(!$conn){
			echo "Can't connect database " . mysqli_connect_error($conn);
			exit;
		}

	if(isset($_GET['bookisbn'])){
		$book_isbn = $_GET['bookisbn'];
	} else {
		echo "Empty query!";
		exit;
	}

	if(!isset($book_isbn)){
		echo "Empty isbn! check again!";
		exit;
	}

	$query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
	$result = mysqli_query($conn, $query);
	if(!$result){
		echo "Can't retrieve data " . mysqli_error($conn);
		exit;
	}
	$row = mysqli_fetch_assoc($result);

	function getGen($conn, $gid){
		$query = "SELECT genre FROM genre WHERE genre_id = '$gid'";
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
		return $row['genre'];
	}
?>
<form method="post" action="edit_book.php" enctype="multipart/form-data">
        <center>
            <div class="top" style="padding-top:10px;">
                <h1>Edit a Book</h1>
            </div>
            <br>
            <div class="box">
            <table class="table">
			<tr>
				<th>ISBN</th>
				<td><input type="text" name="isbn" value="<?php echo $row['book_isbn'];?>" readOnly="true"></td>
			</tr>
			<tr>
				<th>Title</th>
				<td><input type="text" name="title" value="<?php echo $row['book_title'];?>" required></td>
			</tr>
			<tr>
				<th>Author</th>
				<td><input type="text" name="author" value="<?php echo $row['book_author'];?>" required></td>
			</tr>
			<tr>
				<th>Image</th>
				<td><input type="file" name="image"></td>
			</tr>
			<tr>
				<th>Description</th>
				<td><textarea name="descr" cols="40" rows="5" ><?php echo $row['book_desc'];?></textarea></td>
			</tr>
			<tr>
				<th>Price</th>
				<td><input type="text" name="price" value="<?php echo $row['book_price'];?>" required></td>
			</tr>
			<tr>
				<th>Quantity</th>
				<td><input type="text" name="qty" value="<?php echo $row['book_qty'];?>" required></td>
			</tr>
			<tr>
				<th>Genre</th>
				<td><input type="text" name="genre" value="<?php echo getGen($conn, $row['genre_id']); ?>" required></td>
				<!-- Add genre from database here -->
			</tr>
		</table>
        <input type="submit" name="save_change" value="Save changes" class="goto">
		<input type="reset" value="cancel" class="goto">
	</form>
    <br>   <br/>
    <a href="Admin_home.php" class="submit-btn">Confirm</a>
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