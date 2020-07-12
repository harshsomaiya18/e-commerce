<?php
include("db.php");
session_start();
if (!isset($_SESSION['name'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE HTML>
<HTML>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<title>E store</title>
</head>
<BODY style="background-color: lightgreen">


<?php 
include('navb.php');
?>
<h3 style="margin-left: 400px"><b>MY PROFILE </b></h3>
<div  style="border: 1px solid black;border-radius: 20px;border-spacing: 50px;margin-right: 100px;margin-left: 100px;">
<?php
$user=$_SESSION['name'];
$profdet="select * from account where name='$user'"; 
$runquery=pg_query($dbconn,$profdet);
while($getdet=pg_fetch_array($runquery))
{ $name1=$getdet['name'];
  $email1=$getdet['email'];
  $mob1= $getdet['mobile'];
 echo "
 <h4 style='margin-left:200px; margin-bottom:40px;'>Name :  $name1 <br><br><br>
 Email : $email1 <br><br><br>
 Mobile : $mob1 </h4>
 
 ";
 }
  ?>

</div>




<?php
include('footer.php') ; ?>