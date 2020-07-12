<?php
include("db.php");
session_start();
if (!isset($_SESSION['name'])) {
  	echo"<script>alert('You must login first')</script>";
   echo"<script>window.open('index.php','_self')</script>";

  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
 if(isset($_GET['del']))
{
	$id=$_GET['del'];
	$run_que="delete from cart where cart_id=$id";
	$exec=pg_query($dbconn,$run_que);
	
	 
		 
header("location:cart.php");
	

} 	
   if(isset($_GET['user_query']))
  { $pr=$_GET['user_query'];
header("location:shop.php?user_query=$pr");
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
<BODY>

<div id="navbar" class="navbar navbar-default">
	<div class="container">
		<div class="navbar-collapse collapse" id="navigation">
			<div class="padd-nav">
				<ul class="nav navbar-nav left">
					<li ><a href="index.php">Home</a></li>
					<li><a href="shop.php">Shop</a></li>
					<li><a href="#" class="act">Go To Cart <i class="fa fa-shopping-cart"></i></a></li>
					<?php
                    $user=$_SESSION['name'];
                    echo "
					<li><a href='orders.php?submit=$user'>My orders</a></li>
                     ";
                     ?>

 	                
			<li> <form method="get" action="#" class="navbar-form">
					<div class="input-group">
						<input type="text" class="form-control" name="user_query" placeholder="search" required=" "/>
						<span class="input-group-btn">
						<button type="submit" name="Search" value="Search" class="btn btn-primary">
							<i class="fa fa-search"></i>
						</button>
					</span>
				</div>
                     </form>
					</li>
				
				
				
					<?php  if (isset($_SESSION['name'])) : ?>
    	<li class="shift" style="margin-left: 230px;margin-right:0px"><a href="profile.php">Welcome  <h4 style="color:yellow; display:inline;"><?php echo $_SESSION['name']; ?></h4></a></li>
    	 <li><a href="index.php?logout='1'">logout</a></li> 
    <?php endif ?>
					</ul>
				
			</div>
			
</div>
</div>
</div>
<div class="container">
	<div id="cart" class="col-md-9">
	<div class="box">
	<form action="" method="get" enctype="multipart/form-data">
	<h1>Shopping Cart</h1>
	
	<div class="table-responsive">
		<table class="table" style="padding: 10px">
			<thead>
				<tr>
				<th >Product</th>
				<th>Title</th>
				<th>Price</th>
				<th></th>
				


				</tr>
			</thead>
			<tbody>
				
         <?php  
              if (isset($_SESSION['name'])) {
                   $user=$_SESSION['name'];
              $run_q="select * from cart where name='$user' ";
              $query_run=pg_query($dbconn,$run_q);
              while($run_que=pg_fetch_array($query_run))
              {   $prodid=$run_que['prod_id'];
			 $getprice=$run_que['prod_price'];
			 $prodimg=$run_que['prod_img'];
			 $prodtitle=$run_que['prod_title'];
			 $cart=$run_que['cart_id'];
              echo "
              <tr>
					<td>
					<img src='$prodimg' style='width:20%;height:20%'>
					</td>
					<td>
					$prodtitle
					</td>
					<td>
					$getprice
					</td>
					<td>
					<a href='cart.php?del=$cart' class='btn btn-primary'>
            <i class='fa fa-remove' ></i> 
            </a>
					</td>

					</tr>";
			}
		}
				?>
				
			</tbody>
		</table>  
	</div>
	</form>

	
</div>
<?php
global $amt;
$user=$_SESSION['name'];
              $run_q="select * from cart where name='$user' ";
              $query_run=pg_query($dbconn,$run_q);
              while($run_que=pg_fetch_array($query_run))
              { 
                $prodid=$run_que['prod_id'];
                $getprice=$run_que['prod_price'];
                $amt=$amt+$getprice;

                }
            
      echo " <h4><p style='text-align:right;color:white;'> <b>TOTAL AMOUNT : $amt<b></p></h4>
        
						<a href='payments.php?submit=$user&amount=$amt' class='btn btn-primary' style='margin-left:400px; margin-bottom:20px;background-color:green'>
             PROCEED TO CHECKOUT
            </a>
            
			

      ";          

  ?>
</div>

</div>
<?php
include("footer.php");
?>

</BODY>
</HTML>
