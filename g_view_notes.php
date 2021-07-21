<html>
<head>
<title>MyCampus</title>
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
    <a class="navbar-brand" href="index.php">MyCampus</a>
</nav>
	<?php
	echo "<div class='container border mt-3 text-center'>";
    include("connection.php");
    error_reporting(0);
	$note_title = $_GET['note'];
	$teacher = $_GET['teacher'];
    if($note_title){
	$qrr11 = "SELECT * FROM mynotes WHERE note_name='$note_title' && id='$teacher'";
	$data11 = mysqli_query($con,$qrr11);
	$row11 =  mysqli_fetch_assoc($data11);
	echo "<h1>".$row11['note_name']."</h1>";
	echo $row11['data'];
    }
    ?>
</body>
</html>