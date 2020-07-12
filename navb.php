<div id="navbar" class="navbar navbar-default">
	<div class="container">
		<div class="navbar-collapse collapse" id="navigation">
			<div class="padd-nav">
				<ul class="nav navbar-nav left">
					<li ><a href="index.php">Home</a></li>
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
						<button type="submit" name="search" value="Search" class="btn btn-primary">
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
