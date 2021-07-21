<?php
session_start();
error_reporting(0);
include("connection.php");
$id=$_SESSION['id'];
if($id){
    
}
else{
    echo "<script type='text/javascript'>
window.location.href = 'index.php';
</script>";
}
?>

<html>
    <head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <script src="js/reply.js"></script>
        </head>
        
        <body>
            <nav class="navbar navbar-expand-sm bg-info navbar-dark">
                <a class="navbar-brand" href="#">MyCampus</a>
  <ul class="navbar-nav ml-auto">
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#"><?php $id = $_SESSION['id'];
   include("connection.php");
	$qrr="SELECT * FROM users WHERE id='$id' && type='teacher'";
	$data=mysqli_query($con,$qrr);
	$fdata = mysqli_fetch_assoc($data);
	echo $fdata['name']; 
    ?></a>
    <div class="dropdown-menu bg-info">
      <a class="dropdown-item text-warning" href="#" data-toggle="modal" data-target="#profileinfo">Profile</a>
      <a class="dropdown-item text-danger" href="logout.php">Logout</a>
    </div>
  </li>
<br>
  </ul>
</nav>
<div class="row">

	   <div class="col-md-8 mt-2 border">
       <h3>New Feedbacks</h3>
            <?php
                $temp_qrr = "SELECT * FROM feedbacks WHERE teacher_id='$id' && read_noti='NO'";
                $data = mysqli_query($con,$temp_qrr);
                $no_rows = mysqli_num_rows($data);
                if($no_rows>0){
                while($rows_data = mysqli_fetch_assoc($data)){
                    echo "<div class='container border ml-1 mb-1'>";
                    echo "<a href='#' data-toggle='modal' data-target='#viewf'><h5>".$rows_data['student_id']."</h5></a><p class='text-muted'>".$rows_data['date']."</p><p></p>";
                    echo "</div>";
                }
              }else{
                echo "<h5>No Feedbacks Available!<h5>";
              }
            ?>
       </div>

       <div class="col-md-4 mt-2 border">
       <?php
                echo "<h3>Feedbacks</h3>";
                $temp_qrr = "SELECT * FROM feedbacks WHERE teacher_id='$id' && read_noti='YES'";
                $data = mysqli_query($con,$temp_qrr);
                $no_rows = mysqli_num_rows($data);
                if($no_rows>0){
                while($rows_data = mysqli_fetch_assoc($data)){
                    echo "<div class='container border ml-1'>";
                    echo "<h5>".$rows_data['student_id']."<p class='text-muted'>".$rows_data['date']."</p></h5><p>".$rows_data['feedback']."</p>";
                    echo "</div>";
                }
                
              }else{
                echo "<h5>No Feedbacks Available!<h5>";
                
              }
              $up_qrr = "UPDATE feedbacks SET read_noti='YES' WHERE teacher_id='$id'";
              $up_data = mysqli_query($con,$up_qrr);
            ?>
      </div>
       </div>

<!-- View Feedback Modal -->
<div class="modal fade" id="viewf">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title">Feedback</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- body -->
        <div class="modal-body">
          <div class="container mt-4 pt-4 text-left">
          <?php
          $temp_qrr1 = "SELECT * FROM feedbacks WHERE teacher_id='$id'";
          $data1 = mysqli_query($con,$temp_qrr1);
          $no_rows1 = mysqli_num_rows($data1);
          if($no_rows1>0){
              $row_data=mysqli_fetch_assoc($data1);
              echo "<div class='container ml-1'>";
              echo "<h5>".$row_data['student_id']." [".$row_data['date']."]</h5><b>".$row_data['feedback']."</b>";
              echo "</div><div id='replydiv'><input type='hidden' id='studenttxt' value='".$row_data['student_id']."'>";
              echo "<input type='hidden' id='notetxt' value='".$row_data['note_name']."'>";
              echo "<input type='hidden' id='teachertxt' value='".$id."'>";
              echo "<input type='text' id='replytxt' class='form-control mt-1' placeholder='reply..'>";
              echo "<input type='button' id='replybtn' class='btn btn-success mt-1' value='Submit'></div>";
             
          }
          ?>
			</div>
        </div>
        
        <!-- footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

        </body>
        
</html>