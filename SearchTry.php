<!DOCTYPE html>
<html>
<head>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css" /> 

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
</body>
</html>
