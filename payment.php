<?php
include 'dbconnect.php';

	session_start();
	$user=$_SESSION['login_user'];
	$sql = "Select * from users where username='$user'"; 
	$result = mysqli_query($conn, $sql); 
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
	$login_session=$row['username'];
	$id=$row['id'];

	if(!isset($_SESSION['login_user']))
	{
	header("location:login.php");
	die();
	}

    
    if(isset($_COOKIE['id'])){
       
    
if($_SERVER["REQUEST_METHOD"] == "POST") { 

    $type = $_POST["type"]; 
    $ticket=$_COOKIE['id'];
    $sql= "Update ticket SET payment='$type' where id ='$ticket';";
    $result = mysqli_query($conn,$sql); 
    if ($result) { 
        echo ' <p style="color:green">Updated Successfully</p> ';
        header("Location:index.php");
    } 
    else {
        $err=mysqli_error($conn); 
    echo ' <p style="color:red">'. $err.'</p> '; 
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
            table tr{
                
                border-collapse:collapse;
            }
            </style>
    </head>

<body>
    <section>
    <h3 style="text-align:center">WELCOME <?php echo $login_session ?> </h3>
    <a href="logout.php">Log Out</a>


<br>
<form  method="post" action="payment.php" role="form">
<label for="type">Type</label>
        <select name="type" id="type">
            <option value="card">Card</option>
            <option value="cash">Cash</option>
</select>
<button type="submit" >
         Submit
        </button>
</form>
    </section>
</body>
</html>

