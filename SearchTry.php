<!DOCTYPE html>
<html>
<head>
	<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
<?php 
//  -------------------------- Database Usage -----------------------------
// $conn= mysqli_connect("localhost","root","","BookStore");

// -------------------------------REMOTE DATABASE CONNECTION --------------
// $HOST="g1ulxzso4stk.us-east-1.psdb.cloud";
// $USERNAME="7ky85vsj9r7e";
// $PASSWORD="pscale_pw_MjVZvRR2vGs9XwZNXzvhwoUOgvKEJpB-4hDrwxcauW8";
// $DATABASE="peek-a-book";

require 'conn.php';
$conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);


if ($conn->connect_error) 
{
die("<br>Connection failed: " . $conn->connect_error);
}
else
{
$result=mysqli_query($conn,"select * from books");
echo "<select id='searchddl' class='form-control' style='width:230px;' onchange='changeFunc();'>";
echo "<option>Search For Book Name</option>";
$i=0;
while ($row=mysqli_fetch_assoc($result))
{	$i=$row['book_isbn'];
echo "<option value='$i'>$row[book_title]</option>";
}
echo "</select>";	     
mysqli_close($conn);
}
?>
	
<script type="text/javascript">
$("#searchddl").chosen();
</script>
<script type="text/javascript">
function changeFunc() 
{
var selectBox = document.getElementById("searchddl");
var selectedValue = selectBox.options[selectBox.selectedIndex].value;
//alert(selectedValue);
<?php  
if(isset($_SESSION['admin_id']))
{ ?>
	window.location.href = "Admin_edit.php?bookisbn="+selectedValue;
<?php  
}
else 
{ ?>
	window.location.href = "BookDetails.php?bookisbn="+selectedValue;
<?php } ?>

}

</script>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- JavaScript Bundle with Popper -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   
</body>
</html>
