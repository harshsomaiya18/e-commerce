<!DOCTYPE HTML>

<HTML>
<head>
	<?php
include("db.php");
session_start();

  
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<title>E store</title>
</head>
<BODY style="background-color: lightgreen">
 <?php include("navb.php");?>


<div id='container'>
<?php

if (isset($_GET['submit'])) {
	
	 $id=$_GET['submit'];
	 $run_prod1="select * from products where prod_id=$id";
$run_q=pg_query($dbconn,$run_prod1);

while($run_prod=pg_fetch_array($run_q))
{
	$getprice1=$run_prod['prod_price'];
	$prodimg1=$run_prod['prod_img'];
			$prodtitle1=$run_prod['prod_title'];
			$prod_des=$run_prod['prod_desc'];
			
			echo "<H4 style='margin-left:630px'>DETAILS</h4>
			
			<div class='box'>
			<img  class='img-responsive center-block' style='margin-bottom:10px' src='$prodimg1'>
             <p>NAME : $prodtitle1</p>
             <p>DESCRIPTION : $prod_des </p>
             <p>PRICE : $getprice1 </P>

 			</div>
                
			";
   
}

		}
		?>
	</div>
<?php
include("footer.php");
?>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	</BODY>
</HTML>