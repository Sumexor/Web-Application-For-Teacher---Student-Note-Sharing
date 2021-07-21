<?php
session_start();
$id=$_SESSION['id'];
error_reporting(0);
include("connection.php");
if($id){
    
}
else{
    echo " <script type='text/javascript'>
window.location.href = 'index.php';
</script> ";
}
?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
		<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.min.js"></script>	
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote-bs4.css">
	</head>
	
	<body>
	<nav class="navbar navbar-expand-sm bg-info navbar-dark">
                <a class="navbar-brand" href="#">MyCampus</a>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#"><?php $id = $_SESSION['id'];
					include("connection.php");
						$qrr="SELECT * FROM teachers WHERE id='$id'";
						$data=mysqli_query($con,$qrr);
						$fdata = mysqli_fetch_assoc($data);
						echo $fdata['name']; ?></a>
			<div class="dropdown-menu bg-info">
					<a class="dropdown-item text-warning" href="#" data-toggle="modal" data-target="#profileinfo">Profile</a>
					<a class="dropdown-item text-danger" href="logout.php">Logout</a>
			</div>
  </li>
<br>
  </ul>
			</nav>
	<?php
	echo "<div class='container border mt-3 text-center'>";
	$note_title = $_GET['note'];
	$qrr11 = "SELECT * FROM mynotes WHERE note_name='$note_title' && id='$id'";
	$data11 = mysqli_query($con,$qrr11);
	$row11 =  mysqli_fetch_assoc($data11);
	echo "<h1>".$row11['note_name']."</h1>";
	echo $row11['data'];
	
	?>
	
	<div class="contaier border mt-5 mb-3">
	<h3>Feedbacks</h3>
	<?php
	$qrr11 = "SELECT * FROM feedbacks WHERE teacher_id='$id' && note_name='$note_title'";
	$data11 = mysqli_query($con,$qrr11);
	$count = mysqli_num_rows($data11);
	if(count>0){
	while($row11 = mysqli_fetch_assoc($data11)){
		echo "<div class='container border mt-2 mb-2'><h5>" . $row11['student_id'] . "<h5></div>";
	}}else{
		echo "<h5>No feedbacks available!</h5>";
	}
	echo "</div>";
	?>
	</div>
	</body>