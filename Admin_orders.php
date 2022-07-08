<?php
    session_start();
    if(!isset($_SESSION['admin_id']))
    {
      header("Location:HomePage_All.php");
      // $cookie_value=$_SESSION['admin_id'];
      // setcookie($cookie_name, $cookie_value, time()+60,"/");
      // setcookie("visiting_user","",time()-3600,"/"); 
    }
    $conn = mysqli_connect("localhost", "root", "", "bookstore");
    if(!$conn)
    {
        echo "Can't connect database " . mysqli_connect_error($conn);
        exit;
    }
    require_once "Cart_functions.php";
    include "Admin_header.php";

    function getUserInfo($id){
        $conn = mysqli_connect("localhost", "root", "", "bookstore");
          if (!$conn) 
          {
            die("Connection failed: " . mysqli_connect_error());
          }
        $query = "SELECT * from users WHERE id=$id";
        $result = mysqli_query($conn, $query);
        // if there is customer in db, take it out
        if($result){
            $row = mysqli_fetch_assoc($result);
            return $row;
        } else {
            return null;
        }
    }

    ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,600&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');
        .headings{
        font-family: 'Playfair Display', serif;
        }

        .trash{
            background-color: white;
            border: none;
        }
    </style>

    <h2 class="headings" style="padding-top: 20px;"><center>List of all orders</center> </h2>
    
    <div style="margin: 30px; padding:20px; border: 2px solid lightgrey; border-radius: 10px;">
    <?php $type= array();
    $items = array();
    $conn = mysqli_connect("localhost", "root", "", "bookstore");
      if (!$conn) 
      {
        die("Connection failed: " . mysqli_connect_error());
      }
     $query = "SELECT * FROM orders";
     $result = mysqli_query($conn, $query);

     if(mysqli_num_rows($result)==0)
     {
        echo "<h1></h1><br><br>
        <center><br><br><br>
        <h1  class='headings'> You have no Previous Orders, go ahead and place your very first order! </h1>
        <br><br><br><br><br><br></center>";
     }
     else
     {
     for($i = 0; $i < mysqli_num_rows($result); $i++)
      {
        while($row_types = mysqli_fetch_assoc($result))
        {
          array_push($type,$row_types['orderid']);
          echo "<h3 class='headings'>Order ID ".$row_types['orderid']."</h3>";
          echo "<h6>Date of Purchase: ".$row_types['date']."</h6>";
          $row=getUserInfo($row_types['userid']);
          echo "User Name: ".$row['fname']." ".$row['lname']."<br>";
          echo "User Email: ".$row['email']."<br>";
          echo "User Contact: ".$row['contact_1']."<br>";
          echo "User Address: ".$row['address_1'].", ".$row['city']."-".$row['zip'].", ".$row['state']."<br>";
          $items = unserialize($row_types['cart']);
          ?> 
          <div style="width:60%; border:1px solid lightgrey">
          <table class="table">
            <tr>
                <th> Item </th>
                <th> Quantity </th>
            </tr>
            <?php
          foreach ($items as $isbn => $qty) {
            $book = mysqli_fetch_assoc(getBookByIsbn($conn, $isbn));
            ?>
            <tr>
                <td> <?php echo '<img style="margin-right:10px;" src="uploads/'.$book['book_image'].'" height=50, width=50>';
                    echo $book['book_title'] . " by " . $book['book_author']; ?> </td>
                <td> <?php echo $qty ?> </td>
            </tr>
         <?php }
          ?>
         </table></div><br>
         <?php echo "<h5 class='headings'> Total Price: ".$row_types['amount']."</h5>"; ?>
         <hr>
         <?php
              }
          }
        }
         ?>
        </div>

    <br><br>

<p></p>
<?php include "Footer.php"?>
 
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
</body>

</html>