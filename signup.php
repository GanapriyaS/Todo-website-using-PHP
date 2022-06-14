<?php
include 'dbconnect.php';

if($_SERVER["REQUEST_METHOD"] =="POST"){
    $username = $_POST["username"]; 
	$email = (isset($_POST["email"]) ? $_POST["email"] : '');
	$password = $_POST["password"]; 
    $type = $_POST["type"]; 


    $sql = "Select * from users where username='$username'"; 
	$result = mysqli_query($conn, $sql); 
	$num = mysqli_num_rows($result); 

	if($num == 0) { 	
			$sql= "INSERT INTO `users` (username,email,password,type) VALUES ('$username','$email','$password','$type');";
			$result = mysqli_query($conn, $sql); 
			if ($result) { 
				echo ' <p style="color:green">Registered successfully</p> '; 
		        // header("Location:login.php");
			} 
			else
			{
            $err=mysqli_error($conn); 
            echo ' <p style="color:red">'. $err.'</p> '; 
            
			}
		} 
		 
	
if($num>0) 
{ 
	$exists="Username not available"; 
} 
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta naem="viewport" connect="width=device-width,initial-scale=1">
        <title>DEMO</title>
        <style>
            input,select{
                margin-bottom:20px;
            }
            form{
                display:grid;
                justify-items:center;
            }
            </style>
    </head>

<body>
    <section>
    <h3 style="text-align:center">Create an account</h3>

        <form method="post" action="signup.php" role="form">
        
        <label for="username">Username</label>
        <input type="text" required placeholder="Username" name="username" id="username"></input>
<br>
        <label for="password">Password</label>
        <input type="password" required placeholder="Password" name="password" id="password"></input>
        <br>
        <label for="email">Email</label>
        <input type="email" required placeholder="Email" name="email" id="email"></input>
        <br>
        <label for="type">Type</label>
        <select name="type" id="type">
            <option value="admin">Admin</option>
            <option value="other">Other</option>
</select>
<button type="submit" >
          Create
        </button>
</form>
    </section>
</body>
</html>

