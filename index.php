<?php
include("connection.php");
error_reporting(0);
session_start();
?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/index.css" >
        </head>
        
        <body>
            <nav class="navbar navbar-expand-sm bg-info navbar-dark">
                <a class="navbar-brand" href="#">MyCampus</a>
  
</nav>


<div class="container mt-4 pt-4 text-center">
    <form method="POST">
        <input type="text" name="id" size="50" class="form-control mt-4" placeholder="Login id" autocomplete="off" required>
        <input type="password" name="pass" size="50" class="form-control mt-2" placeholder="Password" required>
        <select id="cars" name="type" class="form-control mt-2" required>
            <option value="">Login as:</option>
        <option value="student">Student</option>
        <option value="teacher">Teacher</option>
        </select>
        <input type="submit" value="Login" class="btn btn-success mt-3 form-control" >
    </form>
<p class="text-light">Don't have an account? <a class="text-primary" href="signup.php">SignUp</a></p>
    

            


<?php

$id=$_POST["id"];
$pass=$_POST["pass"];
$type=$_POST["type"];
if($type=="teacher"){
$qrr="SELECT * FROM users WHERE id='$id' && password='$pass' && type='teacher'";
$data=mysqli_query($con,$qrr);
$rows=mysqli_num_rows($data);
if($rows==1){
    $_SESSION['id']=$id;
    echo "<script type='text/javascript'>
window.location.href = 'home.php';
</script>";
}
else{
    echo("Wrong passwrod!");
}
}
else if($type=="student"){
	$qrr="SELECT * FROM users WHERE id='$id' && password='$pass' && type='student'";
$data=mysqli_query($con,$qrr);
$rows=mysqli_num_rows($data);
if($rows==1){
    $_SESSION['id']=$id;
    echo "<script type='text/javascript'>
window.location.href = 's_home.php';
</script>";
}
else{
    echo("<div class='alert alert-danger alert-dismissible'>
	<button type='button' class='close' data-dismiss='alert'>&times;</button>
    <strong>Warning!</strong> You entered wrong <a href='#' class='alert-link'>Email or password</a>.
  </div>");
}
}
?>
</div>
        </body>
		
        
</html>