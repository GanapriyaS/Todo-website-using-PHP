<?php
$server = "localhost";
$username ="root";
$password ="";
$database ="lab2";
$til="";
$cont="";
$update=false;

try {
$conn= mysqli_connect($server,$username,$password,$database);
if($conn){
echo "";
}
}catch(Exception $errormsg){
echo $errormsg->getMessage();
die("Error". mysqli_connect_error());  
}
if(isset($_GET['delete']))
           {
           	$id=$_GET['delete']; 
           	mysqli_query($conn,"DELETE FROM `todo` WHERE id=$id;");
           	header("Location:index.php");

           }
if(isset($_GET['edit']))
           {	
           	
           	$id=$_GET['edit'];
           	$result=mysqli_query($conn,"SELECT * from `todo` WHERE id=$id;"); 
           	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
           	$til=$row['title'];
           	$cont=$row['content'];
           	$update=true;
           	
           }
 if(isset($_REQUEST["update"]))
        	{	
        	$id=$_GET['edit'];
      		$title=trim($_REQUEST["title"]);
    	  	$content=trim($_REQUEST["content"]);
           	mysqli_query($conn,"UPDATE `todo` SET title = '$title', `content` = '$content' WHERE id =$id; ");
           	header("Location:index.php");
           }
?>
