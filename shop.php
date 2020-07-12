<?php
include("db.php");
 session_start();
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: shop.php");
  }
  
?>
<!DOCTYPE HTML>
<HTML>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<title>E store</title>
	
	<script >
$(document).ready(function(){

 

 function load_data(user_query)
 {
  $.ajax({
   url:"searchprod.php",
   method:"POST",
   data:{user_query:user_query},
   success:function(data)
   {
    $('#content2').html(data);
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
<BODY>


<div id="navbar" class="navbar navbar-default">
	<div class="container">
		<div class="navbar-collapse collapse" id="navigation">
			<div class="padd-nav">
				<ul class="nav navbar-nav left">
					
					<li><a href="index.php">Home</a></li>
					<li><a href="shop.php" class="act">Shop</a></li>
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
 	                
			<li> <form method="GET"  class="navbar-form">
					<div class="input-group">
						<input type="text" class="form-control" name="user_query"  id="user_query" placeholder="search" required=" "/>
						<span class="input-group-btn">
						<button type="submit"  class="btn btn-primary">
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
		<li  style='margin-left: 200px;'><a href='profile.php'>Welcome <h4 style='color:yellow; display:inline;marf'>$user</h4></a></li>
    	 <li><a href='index.php?logout=1'>logout</a></li> ";
    	}
     ?>
										</ul>
				
			</div>
			
</div>
</div>
</div>
<div id="content2" >
	<div class="container">
		<div class="row1" style="margin: 0px ">
		<div class="col-md-2" style="height: auto" >
<div class="panel panel-default sidebar-menu" style="background-color: #ececed">
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


	<form method="GET">
		<?php
		global $getprod;
		if(isset($_GET['user_query']))
		{ 
			$userq=$_GET['user_query'];
			
     $getprod="select * from products where prod_title ilike '%$userq%'";
		}
		else
		{
		$getprod="select * from products order by prod_title";
 }
		$runquery=pg_query($dbconn,$getprod);
		while($rowprod=pg_fetch_array($runquery))
		{ $prodid=$rowprod['prod_id'];
			$getprice=$rowprod['prod_price'];
			$prodimg=$rowprod['prod_img'];
			$prodtitle=$rowprod['prod_title'];
         echo "
			<div class='col-md-3' >
			<div class='productshop' id='prod1' >
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
              <a class='btn btn-primary' href='details.php?submit=$prodid'>
              View details
              </a>
            <a href='shop.php?submit=$prodid' class='btn btn-primary' >
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

<?php
include("footer.php");
?>


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


