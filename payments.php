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

  if(($_GET['amount']==0))
  { 
header("location:cart.php");
  }
   
   if(isset($_GET['user_query']))
  { $pr=$_GET['user_query'];
header("location:shop.php?user_query=$pr");
  }
  
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style1.css">
	<title>E store</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">



</head>
<body>
<?php

include('navb.php') ; ?>

<h2>Checkout Form</h2>

<div class="row">
  <div class="col-75">
    <div class="container2">
      <form action="" method="POST">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
           
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="smit@example.com" required=" ">
            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="Somaiya vidyavihar" required=" ">
            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="Mumbai" required=" ">

            <div class="row">
              <div class="col-50">
                <label for="state">State</label>
                <input type="text" id="state" name="state" placeholder="MH" required=" ">
              </div>
              <div class="col-50">
                <label for="zip">Zip</label>
                <input type="text" id="zip" name="zip" placeholder="400077" required=" ">
              </div>
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
            <label for="fname">Accepted Cards</label>
            <div class="icon-container">
              <i class="fa fa-cc-visa" style="color:navy;"></i>
              <i class="fa fa-cc-amex" style="color:blue;"></i>
              <i class="fa fa-cc-mastercard" style="color:red;"></i>
              <i class="fa fa-cc-discover" style="color:orange;"></i>
            </div>
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="smit" required=" ">
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="1111-2222-3333-4444" required=" ">
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="September" required=" ">
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="2019" required=" ">
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="password" id="cvv" name="cvv" placeholder="352" required=" ">
              </div>
            </div>
          </div>
          
        </div>
        <label>
          <input type="checkbox" checked="checked" name="sameadr"> Shipping address same as billing
        </label>
         <br>
          <br>
          <?php
             $amt=$_GET['amount'];
          echo " <p> <h4> Final Amount : RS. $amt </h4></p> "; 
           ?>
        

        
         
        <input type="submit" value="Make Payment"  name="pay" class="btn btn-primary" style="width: 100%">
      </form>
    </div>
  </div>
  
</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</body>
</html>
<?php
if(isset($_POST['pay']))
{

  $name=$_POST['cardname'];
  $num=$_POST['cardnumber'];
  $mon=$_POST['expmonth'];
  $yr=$_POST['expyear'];
  $cvv1=$_POST['cvv'];

  $insertval="insert into payment(card_name,card_num,exp_month,exp_year,card_cvv)values('$name','$num','$mon','$yr','$cvv1')";
  $run_prod=pg_query($dbconn,$insertval);
  global $name1;
  global $getprice;
  global $prodimg;
  global $prodtitle;
  $prodtitle="";
   
   $add=$_POST['address'];
   $city1=$_POST['city'];
   $state1=$_POST['state'];
   $zip1=$_POST['zip'];
   $user=$_SESSION['name'];
$selectval="select * from cart where name='$user'";
$runpr=pg_query($dbconn,$selectval);

while($rowprod=pg_fetch_array($runpr))
{
  $getprice=$rowprod['prod_price'];
   $prodimg=$rowprod['prod_img'];
  $prodtitle=$prodtitle.' , '.$rowprod['prod_title'];
}

 $insertvals="insert into orders(name,address,city,curr_state,zip,product_name,price,order_date) values('$user','$add','$city1','$state1','$zip1','$prodtitle','$getprice',NOW())";
  $runpr=pg_query($dbconn,$insertvals);

  $delitem="delete from cart where name='$user'";
  $runpr=pg_query($dbconn,$delitem);
  echo "<script> window.open('orders.php?submit=$user','_self')</script>";
}
?>