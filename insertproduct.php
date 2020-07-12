
<!DOCTYPE HTML>

<HTML>
<head>
	<?php
include("db.php");
session_start();
if (!isset($_SESSION['name'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
if(isset($_SESSION['name']))
{
	$user=$_SESSION['name'];
	if(strcmp($user,'smitvora')!=0)
	{
		echo "<script>alert('Login as admin first')</script>";
		header('location: index.php');
	}
}  
  if (isset($_GET['logout'])) {
  	session_destroy();
  	
  	header("location: login.php");
  }

   if(isset($_GET['user_query']))
  { $pr=$_GET['user_query'];
header("location:shop.php?user_query=$pr");
  }
?>
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style1.css">
	<title>Insert Products</title>
</head>
<BODY >
	<?php
	include("navb.php");
	?>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="fa fa-money fa-fw"></i>INSERT PRODUCTS

				</h3> 
			</div>
		<div class="panel-body">
			<form method="post" class="form-horiontal" entype="">
				<div class="form-group">
					<label class="col-md-2 control-label" >Product title</label>
					<div class="col-md-10">
						<input name="product_title" type="text" class="form-control" required>
					</div>
				</div>
				
				<div class="form-group">
					
					<label class="col-md-2 control-label" >Product category</label>
					<div class="col-md-10">
						<select  name="product_cat" class="form-control">
							<option>Select the category</option>
							<option value="1">Mobile</option>
							<option value="2">Laptop</option>
							<option value="3">Television</option>
							<option value="4">Refrigerator</option>

						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label" >Product Image</label>
					<div class="col-md-10">
						<input name="product_image" type="text" class="form-control" required>
					</div>
				</div>
			<div class="form-group">
					<label class="col-md-2 control-label" >Product price</label>
					<div class="col-md-10">
						<input name="product_price" type="text" class="form-control" required>
					</div>
				</div>
				<div class="form-group" >
					<label class="col-md-2 control-label" >Product Description</label>
					<div class="col-md-10" style="padding-bottom: 20px">
						<textarea name="product_des" class="form-control" rows="12" cols="14" required></textarea> 
					</div>
				</div>
				<div class="form-group">
					<label class="col-md-2 control-label" ></label>
					<div class="col-md-10">
						<input name="submit" type="submit"value="Insert Product" class="btn btn-primary form-control" required>
					</div>
				</div>
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

if(isset($_POST['submit']))
{
	$title=$_POST['product_title'];
	$img=$_POST['product_image'];
	$price=$_POST['product_price'];
	$des=$_POST['product_des'];
	$cat_id=$_POST['product_cat'];

	$insertval="insert into products(prod_title,prod_date,prod_img,prod_price,prod_desc,prod_catid)values('$title',NOW(),'$img',$price,'$des',$cat_id)";
	$run_prod=pg_query($dbconn,$insertval);

	if ($run_prod) {

		echo "<script>alert('Product inserted successfully')</script>";
		echo "<script>window.open('insertproduct.php,'self' ')</script>";
	}
}
?>