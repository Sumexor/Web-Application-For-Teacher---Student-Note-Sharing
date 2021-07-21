<?php
session_start();
error_reporting(0);
include("connection.php");
$id=$_SESSION['id'];
if($id){
    
}
else{
    echo "<script type='text/javascript'>
window.location.href = 'home.php';
</script>";
}

$note = $_GET['note_name'];
$teacher = $_GET['teacher'];
$qrr = "INSERT INTO fav_notes VALUES('$id','$note','$teacher')";
$data = mysqli_query($con,$qrr);
if($data){
    echo "ok";
}else{
    echo "not";
}
?>