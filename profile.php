<?php
session_start();
include("connection.php");
$id=$_SESSION['id'];
if($id){
    
}
else{
    echo "<script type='text/javascript'>
window.location.href = 'home.php';
</script>";
}
?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        </head>
        
        <body>
            <nav class="navbar navbar-expand-sm bg-info navbar-dark">
                <a class="navbar-brand" href="#">MyCampus</a>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item active">
      <a class="btn btn-danger" href="logout.php">Logout</a>
    </li>
  </ul>
</nav>


<div class="container mt-4 pt-4 border text-center">
   <h1>User id: <b><?php echo $id ?></b></h1><br>
   <h1>Name: <b><?php $id = $_SESSION['id'];
   include("connection.php");
   $qrr="SELECT * FROM teachers WHERE id='$id'";
$data=mysqli_query($con,$qrr);
$fdata = mysqli_fetch_assoc($data);
   echo $fdata['name']; ?></b></h1><br>
   <h1>Gender: <b><?php echo $fdata['gender'] ?></b></h1><br>
   <h1>Email: <b><?php echo $fdata['email'] ?></b></h1><br>
</div>
            
        </body>
        
</html>