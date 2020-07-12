<?php 
include("db.php");
 ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="register1.css" type="text/css"/>
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
<div id="login-box1">
    <div class="left">
      <h2>Login</h2>
      <form method="post" id="regform"> 
      <input type="text" name="username" placeholder="Username" required=""/>
      
      <input type="password" name="password" placeholder="Password" required="" />
     
      
      <input type="submit" name="login" value="Sign me up" />
   <a href="register.php" id="logindet"><h4>Register here !</H4></a>
     
      </form>
      </div>
</div>
</html>
<?php
session_start();
if(isset($_POST['login']))
{
  $names=$_POST['username'];
  $pass=$_POST['password'];
    $query = "SELECT * FROM account WHERE name='$names' AND password='$pass'";
    $results = pg_query($dbconn, $query);
    if (pg_num_rows($results) == 1) {
      $_SESSION['name'] = $names;
      header('location:index.php');
    }
    else{
       echo "<script>alert('username or password do not match')</script>";
       echo "<script>window.open('login.php','self')</script>";
       session_destroy();
    }
}

?>