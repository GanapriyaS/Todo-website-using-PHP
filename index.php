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
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" >

    <title>Todo List</title>
    <style>
	.list-group-item{
	  color:black;
	}
    </style>
</head>
<body>
  <nav style="background:#fcf8e8;" class="container-fluid navbar navbar-light bg-faded fixed-top navbar-expand-lg">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbar1" aria-expanded="false" aria-label="Toggle navigation" name="button"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse " id="navbar1">
          <h1 style="font-weight:bold; text-align:center; color:black;">&nbspTODOS&nbsp</h1>
          <span>
            <div class="bg-transparent border-left-0 d-none d-lg-block"><i class="fas fa-tasks fa-2x" style="color:black;"></i></div>
          </span>
          <div class="col-lg-7">
          </div>
          <div class="col-lg-6 ml-lg-auto">
            <ul class="nav navbar-nav navbar-left">
              <li class="nav-item active">
                <a class="nav-link" href="#"><span class="fa fa-sign-in-alt fa-lg"></span>&nbsp<?php echo $login_session ?></a>
              </li>
              <li class="nav-item "><a class="nav-link btn btn-outline-dark" href="logout.php">Sign Out</a></li>
            </ul>
          </div>
        </div>
  </nav>


    <div class = "container mt-4 " >
      <div style="margin-top:100px;" class="col-12">
        <label id = "lblsuccess" class = "text-success" style = "display: none;"></label>
        
<?php
        if(isset($_REQUEST["submit"]))
        {
        		$title=trim($_REQUEST["title"]);
        		$content=trim($_REQUEST["content"]);
			if(empty($title) || empty($content))
			{
				echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert"> <strong>Please enter todos <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span> </button> </div> '; 
			}
			else
			{
					mysqli_query($conn,"INSERT into `todo`(title,content,userid)value('$title','$content','$id')");
					header("Location:index.php");
					exit;
				
			}
        }
?>

          <form role="form" method="post" >
             <div class="form-group row row-content">
              <label for="title">TODO TITLE</label>
              <input  class="form-control" id="title" type="text" name="title" value="<?php echo $til; ?>" </input>
            </div>
            <div class="form-group row row-content">
              <label for="content">TODO DESCRIPTION</label>
              <textarea  class="form-control" id="content" name="content"><?php echo $cont; ?></textarea>
            </div>
            <div class="form-group row row-content">
            <?php 
            if($update ==true):
            ?>
            <input class="btn btn-outline-primary " style="margin:0 auto; display:block;" id="submit" name="update" type="submit" value="UPDATE" ></input>
            <?php else: ?>
              <input class="btn btn-outline-primary " style="margin:0 auto; display:block;" id="submit" name="submit" type="submit" value="ADD" ></input>
              <?php endif; ?>
            </div>
          </form>
      </div>

  <hr>

        <h2 class = "mt-5" id="todos" style="font-weight:bold;">TASKS</h2>
        <form  style="color:black;">
            <ul class = "card-columns" id = "items">
 <?php
 	$result=mysqli_query($conn,"SELECT * from `todo` WHERE userid=$id;");
 	$num = mysqli_num_rows($result); 
 	
 	for($i=1;$i<=$num;$i++)
 	{
 		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
 
?>
            <li class="card">
            <h4 class="card-title">&nbsp<?php echo $row['title'] ?></h4>
            <h6 class="card-subtitle">&nbsp<?php echo $row['content'] ?></h6>
            <a class="btn-success btn btn-sm float-right"  href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
            <a class="btn-danger btn btn-sm float-right" href="index.php?delete=<?php echo $row['id']; ?>">Delete</a></li>
           <?php
           }           
           ?>
       </ul>
            
        </form>
    </div>
    
 <script src=" https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity=" sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"> </script> 
<script src=" https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity= "sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"> </script> 
<script src=" https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity= "sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"> </script> 
  
</body>
</html>

