<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php #require 'Header_file.php'; ?>
<br><br><br><br>
<center><h1>Signing You Out.....</h1></center>
<?php 

if(isset($_SESSION['sign_out']))
{
	$_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }

    setcookie("auto_login","",time()-3600,"/");

    // Finally, destroy the session.
	unset($_SESSION['user_id']);
	session_unset();
	session_destroy();
	echo "<script>setTimeout(\"location.href = 'HomePage_All.php';\",1500);</script>";
}
else if(isset($_SESSION['admin_sign_out']))
{

    $_SESSION = array();

    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time()-42000, '/');
    }

    setcookie("admin_auto_login","",time()-3600,"/");

    // Finally, destroy the session.
    unset($_SESSION['admin_id']);
    session_unset();
    session_destroy();
    echo "<script>setTimeout(\"location.href = 'HomePage_All.php';\",1500);</script>";
}
?>
</body>
</html>