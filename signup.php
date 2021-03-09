<?php 

$showAlert = false; 
$showError = false; 
$exists=false; 
	
if($_SERVER["REQUEST_METHOD"] == "POST") { 

	
	include 'dbconnect.php'; 
	
	$username = $_POST["username"]; 
	$email = (isset($_POST["email"]) ? $_POST["email"] : '');
	$password = $_POST["password"]; 
	$cpassword = $_POST["cpassword"]; 
	$gender=$_POST["gender"]; 
	$birthdate = $_POST["birthdate"];
	$age= $_POST["age"];
	$mobileno = $_POST["mobileno"];	
	$sql = "Select * from users where username='$username'"; 
	$result = mysqli_query($conn, $sql); 
	$num = mysqli_num_rows($result); 

	if($num == 0) { 
		if(($password == $cpassword) && $exists==false) { 
	
			$hash = password_hash($password,PASSWORD_DEFAULT); 
			$sql= "INSERT INTO `users` (username,email,password,gender,age,birthdate,mobileno,date) VALUES ('$username','$email','$password','$gender','$age','$birthdate','$mobileno',current_timestamp());";
			$result = mysqli_query($conn, $sql); 
			if ($result) { 
				$showAlert = true; 
			} 
			else
			{
			echo mysqli_error($conn);
			}
		} 
		else { 
			$showError = "Passwords do not match"; 
		}	 
	}
	
if($num>0) 
{ 
	$exists="Username not available"; 
} 
}
if($showAlert) { 
	
		echo ' <div class="alert alert-success alert-dismissible fade show" role="alert"> <strong>Success!</strong> Your account is now created and you can login. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> </div> '; 
		header("Location:login.php");
	} 
        if($showError) { 
	
		echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> '. $showError.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button> </div> '; 
} 
		
	if($exists) { 
		echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Error!</strong> '. $exists.'<button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button> </div> '; 
} 
?> 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,">
    <title>Todo App</title>
    <link rel="stylesheet" href= "https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity= "sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
    
</head> 
	
<body> 
	
<section class="section">
    <div class="container">

<div class="columns is-mobile has-text-centered">
  <div class="column is-half is-offset-one-quarter">

    <div class="card">
    <div class="card-content">

    <form method="post" action="signup.php" role="form">
    <h3 class="title is-3">Create an account</h3>

            <div class="field">	 
              <label class="label is-medium" for="username">Username</label>
    			<input class="input" type="text" placeholder="e.g Alex Smith" id="username" name="username" aria-describedby="emailHelp">
          </div>

            <div class="field">
              <label for="email" class="label is-medium">Email</label>
    		<input class="input" type="email" id="email" placeholder="e.g. alexsmith@gmail.com" name="email">
          </div>

            <div class="field">
              <label class="label is-medium" for="password">Password</label>
    		<input class="input" type="password" placeholder="" id="password" name="password">
          </div>

            <div class="field">
              <label class="label is-medium" for="cpassword">Confirm password</label>
    		<input class="input" type="password" placeholder="" id="cpassword" name="cpassword">
    		<small id="emailHelp" class="text-muted"> 
			Make sure to type the same password 
			</small> 
          </div><br>
          <div class="columns is-mobile is-centered">
          <div class="field is-horizontal ">
          <div class="field-label is-medium ">
          <label class="label is-medium">Gender</label>
          </div>
          
  <div class="field-body">
        <label for="male" class="radio">
          <input type="radio" name="gender" value="male" id="male">
          Male
        </label>
        <label for="female" class="radio">
          <input type="radio" id="female" name="gender" value="female">
          Female
        </label>
        <label for="other" class="radio">
          <input type="radio" id="other" name="gender" value="other">
          Other
        </label>
      </div>
          </div>
          </div>
          <br>
          <div class="columns is-mobile is-centered field is-horizontal">
           <label class="label is-medium" for="birthdate">Birthday</label>
           &nbsp&nbsp
	   <input type="date" id="birthdate" name="birthdate"> 
          </div>
          <br>
           <div class="columns is-mobile is-centered field is-horizontal">
           <label class="label is-medium" for="age">Age</label>&nbsp&nbsp
           <input type="number" min=18 max=60  name="age" id="age" >
		</div><br>
		
	   <div class="columns is-mobile is-centered field is-horizontal">
           <label class="label is-medium" for="mobileno">Mobile Number</label>&nbsp&nbsp
           <input type="tel"   name="mobileno" id="mobileno"  pattern="[0-9]{10}" >
		</div>
		

      <div class="field">
        <button type="submit" name="action" class="button is-success">
          Create
        </button>
    </div>
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
  </div>
