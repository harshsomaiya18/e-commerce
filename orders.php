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
  	 if(isset($_GET['user_query']))
  { $pr=$_GET['user_query'];
header("location:shop.php?user_query=$pr");
  }

   if(isset($_GET['getquery']))
  { $dates=$_GET['getquery'];
    $deleteval="delete from orders where order_date='$dates'";
    pg_query($dbconn,$deleteval);
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
<BODY >
<?php
include("navb.php");
?>
<H3 style="color:white ;text-align: center;"> ORDERS </H3>
<?php
$user=$_GET['submit'];
global $flag;
global $totamt;
global $getadd;
global $getcity;
global $getstates;
global $getzip;
$flag=0;
$totamt=0;
$getorder="select * from orders where name='$user'";
$runorder=pg_query($dbconn,$getorder);
while($getdet=pg_fetch_array($runorder))
{  
  $user=$_SESSION['name'];
    $getdate=$getdet['order_date'];
     $getadd=$getdet['address'];
     $getprod=$getdet['product_name'];
    $getcity=$getdet['city'];
    $getstates=$getdet['curr_state'];
    $getzip=$getdet['zip'];
   
   echo "<div class='box'>
   <H4 style='margin-left:20px'> order time : $getdate</h4>
   <H4 style='margin-left:20px'> Shippping to $getadd</h4>
   <h4 style='margin-left:20px'>$getcity, $getstates</h4>
   <h4 style='margin-left:20px'> $getzip</h4>
    <h4 style='margin-left:20px'> PRODUCTS :</h4>
   <h4 style='margin-left:20px'> $getprod</h4>
<a href='orders.php?submit=$user&getquery=$getdate' class='btn btn-primary'>
cancel order
</a>

   </div> ";
   
}
?>
<?php
include("footer.php");
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</BODY>
</HTML>