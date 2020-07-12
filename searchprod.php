<?php
include("db.php");
session_start();

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
<BODY >



<div id="content2" >
	<div class="container">
		<div class="row" style="margin: 0px ">
		<div class="col-md-2" style="height: 200px;" >
<div class="panel panel-default sidebar-menu" style="background-color: #ececed;">
<div class="panel-heading">
	<h3 class="panel-title">Products</h3>

</div>
<div class="panel-body">
	<ul class="nav nav-pills nav-stacked category-menu">
		<li ><a href="catprods.php?prod=1">Mobiles</a></li>
		<li ><a href="catprods.php?prod=2">laptops</a></li>
		<li ><a href="catprods.php?prod=3">Televsions</a></li>
		<li><a href="catprods.php?prod=4">Refrigerators</a></li>
	</ul>
</div>
</div>
</div>


      	
		<?php
		global $getprod;
		if(isset($_POST['user_query']))
		{ $userq=$_POST['user_query'];
     $getprod="select * from products where prod_title ilike '%$userq%'";
		}
		else if(isset($_POST['prod']))
		{
		$pr=$_POST['prod'];
		$getprod="select * from products where prod_catid=$pr";
}
else
{
	$getprod="select * from products  order by prod_title";
}
		$runquery=pg_query($dbconn,$getprod);
		while($rowprod=pg_fetch_array($runquery))
		{
			$getprice=$rowprod['prod_price'];
			$prodimg=$rowprod['prod_img'];
			$prodtitle=$rowprod['prod_title'];
            $prod=$rowprod['prod_id'];
         echo "
			<div class='col-md-3'>
			<div class='productshop'>
            <img class='img-responsive center-block' src='$prodimg'>
            <div class='text'>
            <h4>
            $prodtitle
            </h4>
            </div>
            <p class='price'>
              Rs. $getprice
            </p>
            <p class ='button'>
              <a class='btn btn-primary' href='details.php?submit=$prod'>
              View details
              </a>
            <a href='shop.php?submit=$prod' class='btn btn-primary'>
            <i class='fa fa-shopping-cart'></i> Add to cart
            </a>
            </p>
            </div>
            </div>
			
             ";
		}
	
		?>
			</div>
</div>

</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</BODY>
</HTML>
<?php

if (isset($_GET['submit'])) {
	
if (!isset($_SESSION['name'])) {
  	echo "<script>alert('You must log in first')</script>";
  	}
  else
  {
	$name=$_SESSION['name'];
	 $id=$_GET['submit'];
	 $run_prod1="select * from products where prod_id=$id";
$run_q=pg_query($dbconn,$run_prod1);

while($run_prod=pg_fetch_array($run_q))
{
	$getprice1=$run_prod['prod_price'];
	$prodimg1=$run_prod['prod_img'];
			$prodtitle1=$run_prod['prod_title'];

	$getcart="insert into cart(name,prod_img,prod_price,prod_title,prod_id)values('$name','$prodimg1',$getprice1,'$prodtitle1',$id)";
	$rp=pg_query($dbconn,$getcart);

}
}
}
?>

