<?php
include 'dbconnect.php';
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]==true)
{
	header("Location:index.php");
	exit;
}
if($_SERVER["REQUEST_METHOD"] == "POST") { 
	$username = trim($_POST["username"]); 
	$password = trim($_POST["password"]); 
	if(empty($username) || empty($password))
	{
		echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Please enter username and password <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> </div> '; 
	}
	else
	{	
		$sql = "Select * from users where username='$username';"; 
		$result = mysqli_query($conn, $sql); 
		$num = mysqli_num_rows($result); 
		
		if($num == 1) { 
			echo ' <div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Login sucessfully! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> </div> '; 
			$_SESSION['login_user']=$username;
			echo "<script>window.location.href='index.php';</script>";
			exit;
		}
		else
		{
			echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Invalid username and password <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> </div> '; 
		
		}

	}

}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Todo App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity= "sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> 
  </head>
  <body>

  <section class="section">
    <div class="container">

<div class="columns is-mobile has-text-centered">
  <div class="column is-half is-offset-one-quarter">

    <div class="card">
    <div class="card-content">

          <form method="post" action="" role="form">
           <h3 class="title is-3">Login</h3>

            <div class="field">
  		<label class="label is-medium" for="username">UserName</label>
    			<input class="input" type="text" placeholder="e.g Alex Smith" id="username" name="username">
  		</div>
	    <div class="field">
  	    <label class="label is-medium" for="password">Password</label>
  		
    		<input class="input" type="password" id="password" name="password">
        	</div>         

      <div class="field">
        <button type="submit" value="login" class="button is-success">
          Login
        </button>
    </div>
   <a href="signup.php" class="button is-info">Create an account</a>
  </form>
    </div>
    </div>

  </div>
</div>

    </div>
  </section>
<script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity=" sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"> </script> 
<script src=" https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity= "sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"> </script> 
<script src=" https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity= "sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"> </script> 
  </body>
</html>


