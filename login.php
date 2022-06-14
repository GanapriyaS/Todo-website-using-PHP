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
    $type = $_POST["type"]; 
	if(empty($username) || empty($password))
	{
		echo ' <p style="color:red">Enter username and password</p> ';
	}
	else
	{	
		$sql = "Select * from users where username='$username' and password='$password' and type='$type';"; 
		$result = mysqli_query($conn, $sql); 
		$num = mysqli_num_rows($result); 
		
		if($num == 1) { 
			echo ' <p style="color:green">Logged in successfully</p> ';
			$_SESSION['login_user']=$username;
            $_SESSION['loggedin']=true;
            echo "<h2><a href='index.php'>GO TO HOME</a></h2>";
			// echo "<script>window.location.href='index.php';</script>";
		}
		else
		{
			echo ' <p style="color:red">Invalid username and password</p> ';
		
		}

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

        <form method="post" action="login.php" role="form">
        
        <label for="username">Username</label>
        <input type="text"  placeholder="Username" name="username" id="username"></input>
<br>
        <label for="password">Password</label>
        <input type="password" required placeholder="Password" name="password" id="password"></input>
        <br>
        <label for="type">Type</label>
        <select name="type" id="type">
            <option value="admin">Admin</option>
            <option value="other">Other</option>
</select>
<button type="submit" >
         Login
        </button>
</form>
    </section>
</body>
</html>

