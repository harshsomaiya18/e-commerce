
<!DOCTYPE HTML>

<HTML>
<head>
	<?php
include("db.php");
session_start();
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location:index.php");
  }

   if(isset($_GET['user_query']))
  { $pr=$_GET['user_query'];
header("location:shop.php?user_query=$pr");
  }
?>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<title>E store</title>

<script>
$(document).ready(function(){

 

 function load_data(user_query)
 {
  $.ajax({
   url:"searchprod.php",
   method:"POST",
   data:{user_query:user_query},
   success:function(data)
   {
    $('#content').html(data);
   }
  });
 }
 $("#user_query").keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
 $("#search").click(function(){
console.log("working");
var search = $("#user_query").val();
  if(search != '')
  { console.log(search);
   load_data(search);
  }
  else
  {

   load_data();
  }

 });
});
</script>
</head>
<BODY >


<div id="navbar" class="navbar navbar-default">
	<div class="container">
		<div class="navbar-collapse collapse" id="navigation">
			<div class="padd-nav">
				<ul class="nav navbar-nav left">
					<li ><a href="#" class="act">Home</a></li>
					<li><a href="shop.php">Shop</a></li>
					<li><a href="cart.php">Go To Cart <i class="fa fa-shopping-cart"></i></a></li>
					<?php
					if(isset($_SESSION['name']))
					{
                    $user=$_SESSION['name'];
                    echo "
					<li><a href='orders.php?submit=$user'>My orders</a></li>
                     ";
                     }
                     ?>

 	                
			<li> <form method="get" action="#" class="navbar-form">
					<div class="input-group">
						<input type="text" class="form-control" name="user_query" id="user_query" placeholder="search" required=" "/>
						<span class="input-group-btn">
						<button type="submit" name="search" value="Search" id="search" class="btn btn-primary">
							<i class="fa fa-search"></i>
						</button>
					</span>
				</div>
                     </form>
					</li>
				
		<?php  
					if (!isset($_SESSION['name'])) 
					{
		echo "<li class='shift' style='margin-left: 300px;margin-right:0px'><a href='register.php'>Register</a></li>
    		     <li><a href='login.php'>Login</a></li>
    		";
    	}
    	else
    	{
    		$user=$_SESSION['name'];
    		echo "
		<li style='margin-left: 200px;'><a href='profile.php'>Welcome <h4 style='color:yellow; display:inline'>$user</h4></a></li>
    	 <li><a href='index.php?logout=1'>logout</a></li> ";
    	}
     ?>
					
					</ul>
				
			</div>
			
</div>
</div>
</div>




<div class="carousel slide" id="myCarousel" data-ride="carousel">
	<ol class="carousel-indicators">
    <li  class="active" data-target="#myCarousel" data-slide-to ="0"></li>
     <li data-target="#myCarousel" data-slide-to ="1"></li>
      <li data-target="#myCarousel" data-slide-to ="2"></li>
       <li data-target="#myCarousel" data-slide-to ="3"></li>

	</ol>
	<div class="carousel-inner">
		<?php
    	$res=pg_query($dbconn,"select * from slider where slider_img='oneplus.jpg'");
while($row1 = pg_fetch_array($res))
{
	
echo " 

<div class='item active'>

	<img src='$row1[slider_img]'>
	</div>
	
	" ;
}
$res=pg_query($dbconn,"select * from slider where slider_img='hplap.jpg'");
while($row1 = pg_fetch_array($res))
{
	
echo " 

<div class='item'>

	<img src='$row1[slider_img]'>
	</div>
	
	" ;
}
$res=pg_query($dbconn,"select * from slider where slider_img='samsungtv.jpg'");
while($row1 = pg_fetch_array($res))
{
	
echo " 

<div class='item'>

	<img src='$row1[slider_img]'>
	</div>
	
	" ;
}
$res=pg_query($dbconn,"select * from slider where slider_img='ref.jpg'");
while($row1 = pg_fetch_array($res))
{
	
echo " 

<div class='item'>

	<img src='$row1[slider_img]'>
	</div>
	
	" ;
}
    	
?>
		
	</div>
	<a class="left carousel-control" href="#myCarousel" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
    <span class="sr-only">Next</span>
  </a>

</div>
<div id="advantages">
<div class="container">
<div class="same-hright-row">
<div class="col-sm-4">
<div class="box2 same-height">
<div class="icon">
<i class="fa fa-heart"></i>
</div>	
<a href="#"><h4>CUSTOMER SATISFACTION</h4></a>
<p>WE know our customer wants to be happy<br>Giving the best product experiance here</p>
</div>
</div>
<div class="col-sm-4">
<div class="box2 same-height">
<div class="icon">
<i class="fa fa-tag"></i>
</div>	
<a href="#"><h4>BEST RATES</h4></a>
<p>We give the best rates and you can compare with other officials.<br>Share the amazing site with your close ones</p>
</div>
</div>
<div class="col-sm-4">
<div class="box2 same-height">
<div class="icon">
<i class="fa fa-heart"></i>
</div>	
<a href="#"><h4>ORIGINALITY</h4></a>
<p>100% percent original products worth buying for.<br>Dont miss out a chance now</p>
</div>
</div>
</div>
</div>
</div>
<div id="hot">
	<div class="box">
<div class="container">
	<div class="col-md-12">
		<h2 style="color:red">Our Latest Products</h2>
	</div>
</div>
</div>
</div>
<div id="content" class="container">
		<div class="row1">
		<form method="get">
     <?php
     
		$getprod="select * from products LIMIT 6";

		$runquery=pg_query($dbconn,$getprod);
		while($rowprod=pg_fetch_array($runquery))
		{     $prodid=$rowprod['prod_id'];
			 $getprice=$rowprod['prod_price'];
			 $prodimg=$rowprod['prod_img'];
			 $prodtitle=$rowprod['prod_title'];
         echo "
			<div class='col-md-4'>
			<div class='product'>
            <img class='img-responsive center-block' src='$prodimg'>
            <div class='text'>
            <h4>
            $prodtitle
            </h4>
            </div>
            <p class='price'>
              Rs. $getprice
            </p>
            <p class ='button' >
              <a  href='details.php?submit=$prodid'class='btn btn-primary'>
              View details
              </a>
            <a href='index.php?submit=$prodid' class='btn btn-primary' >
            <i class='fa fa-shopping-cart' ></i> Add to cart
            </a>
            </p>
            </div>
            </div>
			
             ";
		}
		?>
	</form>
	</div>
</div>
		
</div>
</div>
<?php
include("footer.php");
?>
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
  	session_start();
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
