<?php
  session_start();
  require "conn.php";
  $book_isbn = $_GET['bookisbn'];
  // connecto database

if(isset($_SESSION['user_id']))
  {
    include "Header_file.php";
  }
  else
  {
    include "Header_All.php";
  }

  // $conn = mysqli_connect("localhost", "root", "", "bookstore");
  $conn = mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);
    if(!$conn){
      echo "Can't connect database " . mysqli_connect_error($conn);
      exit;
    }

  $query = "SELECT * FROM books WHERE book_isbn = '$book_isbn'";
  $result = mysqli_query($conn, $query);
  if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
  }

  $row = mysqli_fetch_assoc($result);
  if(!$row){
    echo "Empty book";
    exit;
  }

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
?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
  .lead{
    background-color:#E3F2FD; 
    padding: 10px;
  }
  .fa-heart{
  font-size: 25px;
  color: #FB7769;
  margin-left: 5px;
  transform: scale(1,1);
  }
  .fa-heart-o{
    color: black;
    font-size: 25px;
    margin-left: 5px;
    transform: scale(1,1);
  }
  .hurry{
      background-color: #ffc107;
      color: white;
      display: inline-block;
      font-size: 0.7rem;
      padding: .05rem .3rem;
      margin-left: 10px;
    }
  .outofstock{
      background-color: #E74C3C;
      color: white;
      display: inline-block;
      font-size: 0.7rem;
      padding: .05rem .3rem;
      margin-left: 10px;
  }
  </style>
      <!-- Example row of columns -->
      <?php
        if(isset($_SESSION['admin_id']))
      { ?>
      <p class="lead"><a href="Admin_home.php">Home</a> > <?php echo $row['book_title']; ?></p>
      <?php
    }else {?>
       <p class="lead"><a href="HomePage_In.php">Home</a> > <?php echo $row['book_title']; ?></p>
      <?php
    }
       ?>
      <div class="row">
        <div class="col-md-3 text-center">
          <img class="img-responsive img-thumbnail" src="uploads/<?php echo $row['book_image']; ?>" alt="Image unaivalable right now" height=60% width=60%>
          <br><br>
          <?php if($row['book_qty'] <= 5 && $row['book_qty'] != 0) {?>
            <span class="hurry"> Hurry only <?php echo $row['book_qty'] ?> item/s left !!</span>
          <?php } ?>
          <?php if($row['book_qty'] == 0) {?>
            <span class="outofstock"> Sorry the item is out of stock.</span>
          <?php } ?>
        </div>
        <div class="col-md-6">
          <h4>Book Description</h4>
          <p><?php echo $row['book_desc']; ?></p>
          <h4>Book Details</h4>
          <table class="table">
          	<?php foreach($row as $key => $value){
              if($key == "book_desc" || $key == "book_image" || $key == "genre_id" ){
                continue;
              }
              switch($key){
                case "book_isbn":
                  $key = "ISBN";
                  break;
                case "book_title":
                  $key = "Title";
                  break;
                case "book_author":
                  $key = "Author";
                  break;
                case "book_price":
                  $key = "Price";
                  break;
                  case "book_qty":
                  $key = "Items Left";
                  break;

              }
            ?>
            <tr>
              <td><?php echo $key; ?></td>
              <td><?php echo $value; ?></td>
            </tr>
            <?php 
              } ?>
              <tr>
              <td><?php echo "Genre" ?></td>
              <td><?php echo getGenre($conn, $row['genre_id']); ?></td>
            </tr>
            <?php
              if(isset($conn)) {mysqli_close($conn); }
            ?>
          </table>
            <?php
            if(isset($_SESSION['user_id']))
            {
            ?>
            <form method="post" action="Cart.php">
            <?php $book_isbn=$row['book_isbn']; ?>
            <input type="hidden" name="bookisbn" value="<?php echo $book_isbn;?>">
            <?php if($row['book_qty'] == 0) { ?>
            <button type="submit" class="btn btn-primary" disabled> Item is Out of Stock</button>
          <?php } else { ?>
            <button type="submit" class="btn btn-primary" ><i class="fa fa-shopping-cart pr-2"></i>Add to cart</button>
          <?php } ?>
            <a href="Wishlist.php?bookisbn=<?php echo $row['book_isbn'];?>" >
              <?php 
                 if(isset($_SESSION['wishlist'][$row['book_isbn']]))
                 { ?>
                  <i class="heart fa fa-heart" aria-hidden="true"></i>
               <?php  } else { ?> 
                  <i class="heart fa fa-heart-o" aria-hidden="true"></i>
               <?php } ?>
               </a>
             </form>
            <?php
            }
            else
            {
            ?>
             <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-shopping-cart pr-2"></i>Add to cart</button><button type="button" class="btn wishlist" data-toggle="modal" data-target="#exampleModalCenter"><i class="heart fa fa-heart-o" aria-hidden="true"></i></button>
            <?php }
            
            ?>
       	</div>
      </div>
      <br><br>
       <script>
    $(".heart.fa").click(function() {
        $(this).toggleClass("fa-heart fa-heart-o");
    });
  </script>
   <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body" style= "text-align: justify; padding: 20px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                Hello Stranger ! 
                <br> Please Sign Up / Sign In to access add to cart or wishlist.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="Redirect(1)">Sign Up</button>
                <button type="button" class="btn btn-primary" onclick="Redirect(2)">Sign In</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
  
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php
  require "Footer.php";
?>