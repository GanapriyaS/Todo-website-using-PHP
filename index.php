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


   

    if(isset($_GET["book"]))
    {	 
$ticket=$_GET["book"];
$sql = "Select * from ticket where id='$ticket'"; 
$res = mysqli_query($conn, $sql); 
$res=mysqli_fetch_array($res,MYSQLI_ASSOC);

if($res["book"]==0) { 	

   $sql= "Update ticket SET book=true where id ='$ticket';";
            $result = mysqli_query($conn,$sql); 
            if ($result) { 
                echo ' <p style="color:green">Booked Successfully</p> ';
                setcookie("id",$ticket,time()+3600,"/","",0);
                header("Location:payment.php");
            } 
            else {
                $err=mysqli_error($conn); 
            echo ' <p style="color:red">'. $err.'</p> '; 
            }
        }
    else{
        echo ' <p style="color:red">Already booked</p> ';
    }
    }


    if(isset($_GET['delete']))
{
    $id=$_GET['delete']; 
    // $result=mysqli_query($conn,"DELETE FROM `ticket` WHERE id=$id;");
    $sql= "Update ticket SET book=false where id ='$id';";
            $result = mysqli_query($conn,$sql); 
    if ($result) { 
		echo ' <p style="color:green">Deleted Successfully</p> ';
	} 
	else {
		$err=mysqli_error($conn); 
            echo ' <p style="color:red">'. $err.'</p> '; 
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
<table border='1'>
  <thead >
    <tr>
      <th>S.no</th>
      <th>from</th>
      <th>to</th>
      <th>depature</th>
      <th>arrival</th>
      <th>rate</th>
    </tr>
  </thead>
  <tbody>
  <?php
 	$result=mysqli_query($conn,"SELECT * from `ticket`;");
 	$num = mysqli_num_rows($result); 
 	
 	for($i=1;$i<=$num;$i++)
 	{
 		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
 
?>
  
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $row['from_place'] ?></td>
      <td><?php echo $row['to_place'] ?></td>
      <td><?php echo $row['depature'] ?></td>
      <td><?php echo $row['arrival'] ?></td>
      <td><?php echo $row['rate'] ?></td>
      
      
      <td>
      <a style="color:green" href="index.php?book=<?php echo $row['id']; ?>">book</a>
      </td>
    </tr>
  
  <?php
      }           
  ?>
  </tbody>
  </table>


  <br>

  <table border='1'>
  <thead >
    <tr>
      <th>S.no</th>
      <th>from</th>
      <th>to</th>
      <th>depature</th>
      <th>arrival</th>
      <th>rate</th>
    </tr>
  </thead>
  <tbody>
  <?php
 	$result1=mysqli_query($conn,"SELECT * from `ticket` where book=1;");
 	$num = mysqli_num_rows($result1); 
 	
 	for($i=1;$i<=$num;$i++)
 	{
 		$row1=mysqli_fetch_array($result1,MYSQLI_ASSOC);
 
?>
  
    <tr>
      <td><?php echo $i ?></td>
      <td><?php echo $row1['from_place'] ?></td>
      <td><?php echo $row1['to_place'] ?></td>
      <td><?php echo $row1['depature'] ?></td>
      <td><?php echo $row1['arrival'] ?></td>
      <td><?php echo $row1['rate'] ?></td>
      
      <td>
      <a style="color:red" href="index.php?delete=<?php echo $row['id']; ?>">delete</a>
      </td>
      
    </tr>
  
  <?php
      }           
  ?>
  </tbody>
  </table>
    </section>
</body>
</html>

