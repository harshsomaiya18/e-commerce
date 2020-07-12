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
<div id="login-box">
    <div class="left">
      <h1>Sign up</h1>
      <form action="" id="regform" method="post"> 
      <input type="text" name="username" placeholder="Username" required=""/>
      <input type="text" name="email" placeholder="E-mail" required=""/>
      <input type="text" name="contact" placeholder="Mobile" required=""/>
      <input type="password" name="password" placeholder="Password" required="" />
      <input type="password" name="password2" placeholder="Confirm Password" required=""/>
      
      
      <a href="login.php" id="logindet"><h4>Already a user?</H4></a>
        <input  type="submit" name="register" value="Sign me up" class="btn btn-primary" />
      </form>
    </div>
    
    
  </html>
  <?php 
  session_start();
if(isset($_POST['register']))
{
  $names=$_POST['username'];
  $emails=$_POST['email'];
  $mob=$_POST['contact'];
  $pass=$_POST['password'];
  $pass2=$_POST['password2'];

  $user_check_query = "SELECT * FROM account WHERE name='$names' OR email='$emails' LIMIT 1";
  $result = pg_query($dbconn, $user_check_query);
  $user = pg_fetch_array($result);
  
  if ($user) { // if user exists
    if ($user['name'] == $names) {
      echo "<script>alert('Username already exists')</script>";
      echo "<script>window.open('register.php','__self')</script>";
      session_destroy();
    }

    if ($user['email'] == $emails) {
       echo "<script>alert('email already exists')</script>";
       echo "<script>window.open('register.php','self')</script>";
       session_destroy();
    }
  }
  else
  {
 
  if($pass==$pass2)
  {

  $insertval="insert into account(name,email,mobile,password)values('$names','$emails',$mob,'$pass')";
  $run_prod=pg_query($dbconn,$insertval);
 $_SESSION['name'] = $names;
  if ($run_prod) {

    echo "<script>alert('User Registerd successfully')</script>";
    echo "<script>window.open('login.php','_self')</script>";

  }
}
else
{
  echo "<script>alert('passwords do not match pls try again')</script>";
    echo "<script>window.open('register.php','__self')</script>";
  }
}
}

   ?>