<?php
$server="localhost";
$username="root";
$password="";
$database="sem";

try{
$conn = mysqli_connect($server,$username,$password,$database);
echo "Connected";
}
catch(Exception $err){
    echo $err->getMessage();
    die("Error".mysqli_connect_error());
}

?>