<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile Page</title>
    <link rel="stylesheet" type="text/css" href="Profile_StyleSheet.css">
    <script type = "text/javascript">
      function Redirect() 
      {
         window.location = "HomePage_In.php";
      }       
    </script>
</head>
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Lobster&display=swap');
    .headings{
        font-family: 'Lobster', cursive;
        color: #3498DB;
        display: inline; 
    }

        .error {
        color: #FF0000;
        display: inline; 
    }
    .goto{
        margin: 0px 50px;
        padding: 10px 40px;
        background-color: #AED6F1;
        border: 1px solid white;
        border-radius: 30px;
        color: white; 
        cursor: pointer;
    }
    </style>
<body>
<div class="profile_top">
      <form>
         <input type = "button"  class="goto" value = "Go To Home Page" onclick = "Redirect();" />
      </form>
</div>
  <center>
   <br>
   <!-- ------------ PHP code for user info storing ----------------- -->
   <?php 
      $gender=$age="";
      $p=$phone="";
      $g=$a=$ph=$check_fn=$check_ln=$l3=$l4=$l5=0;
      $re_fn=$re_ln="";
      $loc_3=$loc_4=$loc_5="";
      if ($_SERVER["REQUEST_METHOD"] == "POST")
      {
         if(isset($_POST['submit']))
         {
	         
	         if (empty($_POST["gender"]) )
	         {
	           $gender="Gender is a required field";
	         } 
	         else
	         {
	          $g=1;
	         }
	         if (empty($_POST["Phone"]) )
	         {
	           $phone="Phone is a required field";
	         } 
	         else
	         {
	          if(!preg_match("/^[0-9]{10}$/", $_POST["Phone"])) 
	          {
	              $p="Please enter Valid phone number";
	          }
	          else
	          {
	          	  $ph=1;
	          }
	         }
	         if (empty($_POST["input_fn"]) )
	         {
	         	$re_fn="First name is a required field";
	         }
	         else
	         {
      				if(!preg_match("/^[a-zA-Z\\s]*$/", $_POST["input_fn"])) 
      				{
      				  $re_fn="Please enter Valid First Name";
      				}
      				else
      				{
      				  $check_fn=1;
      				}
	         }
	         if (empty($_POST["input_ln"]))
	         {
	         	$re_ln="Last name is a required field";
	         }
	         else
	         {
	         	if(!preg_match("/^[a-zA-Z\\s]*$/", $_POST["input_ln"])) 
      				{
      				  $re_ln="Please enter Valid Last Name";
      				}
      				else
      				{
      				  $check_ln=1;
      				}
	         }
           if (empty($_POST["add_3"]))
           {
            $loc_3="State is required";
           }
           else
           {
            
            if(!preg_match("/^[A-Za-z ]+$/", $_POST["add_3"]))
            {
              $loc_3="Please Enter valid State";
            }
            else
            {
              $l3=1;
            }
           }

           if (empty($_POST["add_4"]))
           {
            $loc_4="City is required";
           }
           else
           {
            
            if(!preg_match("/^[A-Za-z]+$/", $_POST["add_4"]))
            {
              $loc_4="Please Enter valid City";
            }
            else
            {
              $l4=1;
            }
           }

           if (empty($_POST["add_5"]))
           {
            $loc_5="Zip is required";
           }
           else
           {
            
            if(!preg_match("/^[1-9]{1}[0-9]{2}[0-9]{3}$/", $_POST["add_5"]))
            {
              $loc_5="Please Enter valid Zip";
            }
            else
            {
              $l5=1;
            }
           }

	         if($g==1 && $ph==1 && $check_ln==1 && $check_fn==1 && $l3==1 && $l4==1 && $l5==1)
	         {
	         	
            // ---------------------------------Database----------------------------------------------
	           $contact1=$_POST["Phone"]; 
	           //$contact2=$_POST["AltPhone"]; 
	           $address1 = $_POST['add_1'];
	           //$address2=$_POST['add_2'];
	           $state=$_POST['add_3'];
	           $city =$_POST['add_4'];
	           $zip=$_POST['add_5'];
	           $gen=$_POST["gender"];
	           //$age_sec=$_POST["age"];
	           $genre=$_POST["genre"];
	           $changed_fn=$_POST["input_fn"];
	           $changed_ln=$_POST["input_ln"];

             if (count($genre)==0) 
             {
               $chk=NULL;
             } 
             else
             {
                $chk=serialize($genre);
             }
             
	          
	            // -----------------------------------
	          $servername = "localhost";
	          $username = "root";
	          $password = "";
	          $dbname = "BookStore";
	          // $conn = mysqli_connect($servername, $username, $password, $dbname);
            include "conn.php";
	          $conn= mysqli_connect($HOST,$USERNAME,$PASSWORD,$DATABASE);

	          if (!$conn) 
	          {
	            die("Connection failed: " . mysqli_connect_error());
	          }

	          $id=$_SESSION['user_id'];
	          $query = "UPDATE users SET fname=?,lname=?,contact_1=?,address_1=?,state=?,city=?,zip=?,gender=?,genre=? WHERE id=?";
	          $pst = mysqli_prepare($conn,$query);
	          mysqli_stmt_bind_param($pst,"ssssssissi",$changed_fn,$changed_ln,$contact1,$address1,$state,$city,$zip,$gen,$chk,$id);
	          mysqli_stmt_execute($pst);
	          mysqli_stmt_close($pst);
	          mysqli_close($conn);
            echo "Done";
	          header("Location:HomePage_In.php");
	         }
        }
      }
      ?>
      <!-- ------------ PHP code for user info storing ends ----------------- -->
<div class="profilec">
        <div style="margin-right:40px;">
        <br>
        <h2 class="headings"> Profile Picture: </h2>  
        <br><br>
        <div class="profileb" style="width:450px; padding:50px 15px">
            <div style="width:fit-content;text-align-last: left;">
                <form action="UserProfile.php" enctype="multipart/form-data" method="post">
                Select Image :
                <input type="file" name="file">
                <input type="submit" value="Upload" name="Submit1"> 
                <br><br>
                Remove Profile Picture:
                <input type="submit" name="Delete" value="Remove">
              </form>
            </div>
          </div>
        </div>
        <div>
          <div class="profile" style="width:200px">
          <div style="width:fit-content;">

      	<!-- --------------- PHP Code for display pic ------------------------- -->
        <?php
        	$new=0;
           if(isset($_SESSION['user_id']))
           { 
              $con= mysqli_connect("localhost","root","","BookStore");
              if ($con->connect_error) 
              {
                die("<br>Connection failed: " . $con->connect_error);
              }
              else
              {
                $id=$_SESSION['user_id'];
                $imgdb="select display_pic from users where id=?";
                $prep_img=mysqli_prepare($con,$imgdb);
                if($prep_img == false) 
                {
                  die("<pre>".mysqli_error($con).PHP_EOL.$imgdb."</pre>");
                }
                mysqli_stmt_bind_param($prep_img,"i",$id);
                mysqli_stmt_execute($prep_img);
                $res=mysqli_stmt_get_result($prep_img);
                $res=mysqli_fetch_array($res);
                if(is_null($res['display_pic'])==FALSE)
                {

                  echo '<img height="200" width="200" style="border-radius:50%;" src="data:image;base64,'.$res['display_pic'].'">';
                }
                else
                {
                  echo "<p>You Have not uploaded a profile picture.</p>";
                }
                mysqli_close($con);
            }
          }
          if(isset($_POST['Submit1']))
          { 
            $uploadedimg = "uploads/" . $_FILES["file"]["name"];
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($uploadedimg,PATHINFO_EXTENSION));
            $filepath = "uploads/" . $_FILES["file"]["name"];
            $error="";
            $finalerror="";

            if (file_exists($uploadedimg)) 
            {
              echo '<script>alert("Sorry, file already exists.")</script>'; 
              #$error= "Sorry, file already exists.";
              $uploadOk = 0;
            }
            if ($_FILES["file"]["size"] > 500000) 
            { 
              echo '<script>alert("Sorry, your file is too large.")</script>'; 
              #$error= "Sorry, your file is too large.";
              $uploadOk = 0;
            } 

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
            {
              echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")</script>'; 
              #$error= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
            }
            if ($uploadOk == 0) 
            {
              echo '<script>alert("Sorry, your file was not uploaded.")</script>'; 
              #$finalerror= "Sorry, your file was not uploaded.";
              #echo "<p>$error $finalerror</p>";
            }
            else
            { 
              $con= mysqli_connect("localhost","root","","BookStore");
              if ($con->connect_error) 
              {
                die("<br>Connection failed: " . $con->connect_error);
              }
            else
            {
              if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath))
              {

                $data=file_get_contents($filepath);
                $data=base64_encode($data);
                $id=$_SESSION['user_id'];

                $imgdb="update users set display_pic=? where id=?";
                $prep_img=mysqli_prepare($con,$imgdb);
                if($prep_img == false) 
                {
                  die("<pre>".mysqli_error($con).PHP_EOL.$imgdb."</pre>");
                }
                mysqli_stmt_bind_param($prep_img,"si",$data,$id);
                mysqli_stmt_execute($prep_img);
                mysqli_close($con);
                unlink($uploadedimg);
                echo "<meta http-equiv='refresh' content='0'>";
                #echo "<script>window.location.reload();</script>";
              }
            }
            }
          }
          if(isset($_POST['Delete']))
          {
            $con= mysqli_connect("localhost","root","","BookStore");
            if ($con->connect_error) 
            {
              die("<br>Connection failed: " . $con->connect_error);
            }
            $id=$_SESSION['user_id'];
            $del="update users set display_pic=NULL where id=?";
            $del_img=mysqli_prepare($con,$del);
            $set_null=NULL;
            if($del_img == false) 
            {
              die("<pre>".mysqli_error($con).PHP_EOL.$del."</pre>");
            }
            mysqli_stmt_bind_param($del_img,"i",$id);
            mysqli_stmt_execute($del_img);
            mysqli_close($con);
            echo "<meta http-equiv='refresh' content='0'>";
          }

        ?>
        <!-- --------------- PHP Code for display pic ends ------------------------- -->
        </div>
        </div>
        </div>
      </div>
  <br>
  <br>
  <form method="post" action= "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
     <h2 class="headings"> Name: </h2> <span class="error">* <?php echo "$re_fn $re_ln";?></span>
     <br> <br>
      <div class="block1">
        <div class="profilea"> 
        <!-- ------------------------ PHP code Retrieving User name from db ------------------ -->
        <?php 
			$con= mysqli_connect("localhost","root","","BookStore");
			if ($con->connect_error) 
			{
				die("<br>Connection failed: " . $con->connect_error);
			}
			else
			{
				$id=$_SESSION['user_id'];
				$ret_name="select * from users where id=?";
                $prep_name=mysqli_prepare($con,$ret_name);
                if($prep_name == false) 
                {
                  die("<pre>".mysqli_error($con).PHP_EOL.$ret_name."</pre>");
                }
                mysqli_stmt_bind_param($prep_name,"i",$id);
                mysqli_stmt_execute($prep_name);
                $name_ret=mysqli_stmt_get_result($prep_name);
                $name_ret=mysqli_fetch_array($name_ret);
                $db_fname="";	
                $db_lname="";
                $liked_genre=$user_gender="";
                $cont=$add_line=$st=$cty=$zc=$liking="";
                if(is_null($name_ret['fname'])==FALSE)
                {
                	$db_fname=$name_ret['fname'];
                }
                if(is_null($name_ret['lname'])==FALSE)
                {
                	$db_lname=$name_ret['lname'];
                }
                if(is_null($name_ret['contact_1'])==FALSE)
                {
                	$cont=$name_ret['contact_1'];
                }
                if(is_null($name_ret['address_1'])==FALSE)
                {
                	$add_line=$name_ret['address_1'];
                }
                if(is_null($name_ret['state'])==FALSE)
                {
                	$st=$name_ret['state'];
                }
                if(is_null($name_ret['city'])==FALSE)
                {
                	$cty=$name_ret['city'];
                }
                if(is_null($name_ret['zip'])==FALSE)
                {
                	$zc=$name_ret['zip'];
                }
                if(is_null($name_ret['gender'])==FALSE)
                {
                  $user_gender=$name_ret['gender'];
                }
                if(is_null($name_ret['genre'])==FALSE)
                {
                	$liking=unserialize($name_ret['genre']);

                	foreach ($liking as $key) 
                  {
                    $liked_genre=$liked_genre." ".$key;
                  }
                }
                mysqli_close($con);
            }

        ?>
        <!-- ------------------------ PHP code Retrieving User name from db ends ------------------ -->
          <input type="text" name="input_fn" class="inputb" placeholder="First Name" value="<?php echo $db_fname; ?>" >
          <br><br>
          <input type="text" name="input_ln" class="inputb" placeholder="Last Name"  value="<?php echo $db_lname; ?>">
        </div>
      </div>
      <br>
      <div class="profilec">
        <div style="margin-right:50px;">    
          <h2 class="headings"> Gender: </h2><span class="error">* <?php echo $gender;?></span>
          <br><br>
          <div class="profileb" style="width:225px">
            <div style="width:fit-content;text-align-last: left;">
              <input type="radio" name="gender" value="F" id="F" <?php if(strpos($user_gender, "F")!==FALSE) echo 'checked="checked"'; ?>> Female <br>
              <input type="radio" name="gender" value="M" id="M" <?php if(strpos($user_gender, "M")!==FALSE) echo 'checked="checked"'; ?>> Male <br>
              <input type="radio" name="gender" value="Other" id="O" <?php if(strpos($user_gender, "O")!==FALSE) echo 'checked="checked"'; ?>> Other <br><br>
            </div>
          </div>
        </div>
        <div>
           <h2 class="headings"> Contact Number: </h2><span class="error">* <?php echo "$phone $p";?></span>
            <br><br>
            <div class="block1">
              <div class="profilea"> 
                <input type="text" name="Phone" class="inputb" placeholder="Contact Number" style="width: 180px" value="<?php echo $cont; ?>"> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <br>
      <h2 class="headings"> Address: </h2> <br><br>
      <div class="profileb">
        <input type="text" name="add_1" class="inputb" placeholder="Address/Location/Landmark" value="<?php echo $add_line; ?>" style="width: 575px"> 
        <div class="profilec"> 
          <input type="text" name="add_3" class="inputb" placeholder="State" value="<?php echo $st; ?>" style="width: 200px"> <span class="error">* <?php echo "$loc_3";?></span>
          <input type="text" name="add_4" class="inputb" placeholder="City" value="<?php echo $cty; ?>" style="width: 125px"> <span class="error">* <?php echo "$loc_4";?></span>
          <input type="text" name="add_5" class="inputb" placeholder="Zip Code" value="<?php echo $zc; ?>" style="width: 125px"> <span class="error">* <?php echo "$loc_5";?></span>
        </div>
      </div>
      <br>
     
      <h2 class="headings"> Please Select the Genre you like:</h2> <br><br>
      <div class="profileb" style="width:570px">
        <div style="width:fit-content;text-align-last: left;">
          <input type="checkbox" id="myst" name="genre[]" value="Mystery" <?php if(strpos($liked_genre, "Mystery")!==FALSE) echo 'checked="checked"'; ?>>
          <label for="myst">Mystery</label>
          <br>
          <input type="checkbox" id="rom" name="genre[]" value="Romantic" <?php if(strpos($liked_genre, "Romantic")!==FALSE) echo 'checked="checked"'; ?>>
          <label for="rom">Romantic</label>
          <br>
          <input type="checkbox" id="acti" name="genre[]" value="Action" <?php if(strpos($liked_genre, "Action")!==FALSE) echo 'checked="checked"'; ?>>
          <label for="acti">Action</label>
          <br>
          <input type="checkbox" id="thrill" name="genre[]" value="Thriller" <?php if(strpos($liked_genre, "Thriller")!==FALSE) echo 'checked="checked"'; ?>>
          <label for="thrill">Thriller</label>
          <br>
          <input type="checkbox" id="fict" name="genre[]" value="Fiction" <?php if(strpos($liked_genre, "Fiction")!==FALSE) echo 'checked="checked"'; ?>>
          <label for="fict">Fiction</label>
          <br>
          <input type="checkbox" id="edu" name="genre[]" value="Education" <?php if(strpos($liked_genre, "Education")!==FALSE) echo 'checked="checked"'; ?>>
          <label for="edu">Education</label>
          <br>
          <input type="checkbox" id="com" name="genre[]" value="Comedy" <?php if(strpos($liked_genre, "Comedy")!==FALSE) echo 'checked="checked"'; ?>>
          <label for="com">Comedy</label>
          <br>
          <input type="checkbox" id="fant" name="genre[]" value="Fantasy" <?php if(strpos($liked_genre, "Fantasy")!==FALSE) echo 'checked="checked"'; ?>>
          <label for="fant">Fantasy</label>
          <br>  
          <input type="checkbox" id="scifi" name="genre[]" value="Sci-Fi" <?php if(strpos($liked_genre, "Sci-Fi")!==FALSE) echo 'checked="checked"'; ?>>
          <label for="scifi">Sci-Fi</label>
          <br>  
          <input type="checkbox" id="drama" name="genre[]" value="Drama" <?php if(strpos($liked_genre, "Drama")!==FALSE) echo 'checked="checked"'; ?>>
          <label for="drama">Drama</label>
          <br> 
          <input type="checkbox" id="horror" name="genre[]" value="Horror" <?php if(strpos($liked_genre, "Horror")!==FALSE) echo 'checked="checked"'; ?>>
          <label for="horror">Horror</label>
          <br> 
          <input type="checkbox" id="health" name="genre[]" value="Health" <?php if(strpos($liked_genre, "Health")!==FALSE) echo 'checked="checked"'; ?>>
          <label for="health">Health</label>
          <br> 
        </div>
      </div>
      <br>
      <button type='submit' name='submit' class="confirm-btn">Confirm</button>
  </form>
  </center>
</body>
</html>
