<?php
session_start();
$cookie_name="admin_auto_login";
if(isset($_SESSION['admin_id']))
{
  $cookie_value=$_SESSION['admin_id'];
  setcookie($cookie_name, $cookie_value, time()+60,"/");
  setcookie("visiting_user","",time()-3600,"/"); 
}
else
{
  header("Location:HomePage_All.php");
  #echo "<script>setTimeout(\"location.href = 'HomePage_All.php';\");</script>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Books</title>
    <link rel="stylesheet" type="text/css" href="ContactStyleSheet.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font awesome and jQuery -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      .goto{
        /* margin: 0px 50px; */
        padding: 10px 40px;
        background-color: #AED6F1;
        border: 2px solid white;
        border-radius: 30px;
        color: white; 
        cursor: pointer;
        margin: 10px 0px 0px 30px;
    }
    .box{
        width: fit-content;
        margin: 10px 30px;
    }
    </style>
</head>
<body style="background-color:#E3F2FD;">
<?php
include "Admin_header.php";

function getGenre($conn, $gid){
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

$conn = mysqli_connect("localhost", "root", "", "bookstore");
if(!$conn){
    echo "Can't connect database " . mysqli_connect_error($conn);
    exit;
}

$query = "SELECT * from books ORDER BY book_isbn DESC";
$result = mysqli_query($conn, $query);
		if(!$result){
			echo "Can't retrieve data " . mysqli_error($conn);
			exit;
		}
?>
<button class="goto" onclick="window.location='Admin_add.php'"><i class="fa fa-plus" style="margin-right: 10px;"> </i>Add new book</button> 
<center>
            <div class="top" style="padding-bottom:20px;">
                <h1>List of all Books</h1>
            </div>
<div class="box">

<table class="table" style="margin-top: 20px">
		<tr>
			<th>ISBN</th>
			<th>Title</th>
			<th>Author</th>
			<th>Image</th>
			<th>Description</th>
			<th>Price</th>
            <th>Quantity</th>
			<th>Genre</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php while($row = mysqli_fetch_assoc($result)){ ?>
		<tr>
			<td><?php echo $row['book_isbn']; ?></td>
			<td><?php echo $row['book_title']; ?></td>
			<td><?php echo $row['book_author']; ?></td>
			<td><?php echo $row['book_image']; ?></td>
			<td><?php echo $row['book_desc']; ?></td>
			<td><?php echo $row['book_price']; ?></td>
            <td><?php echo $row['book_qty'];?></td>
			<td><?php echo getGenre($conn, $row['genre_id']); ?></td>
			<td><a href="Admin_edit.php?bookisbn=<?php echo $row['book_isbn']; ?>">Edit</a></td>
			<td><a href="Admin_delete.php?bookisbn=<?php echo $row['book_isbn']; ?>">Delete</a></td>
		</tr>
		<?php } ?>
    </table>
        </div>
	<br/>
    </div>
        </center>
<br><br><br>

<p></p>
<?php include "Footer.php"?>
 
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
</body>

</html>