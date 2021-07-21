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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/s_home.css">
		<script src="js/s_home.js"></script>
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
	echo $fdata['name']; ?></a>
    <div class="dropdown-menu bg-info">
      <a class="dropdown-item text-warning" href="#" data-toggle="modal" data-target="#profileinfo">Profile</a>
      <a class="dropdown-item text-danger" href="logout.php">Logout</a>
    </div>
  </li>
<br>
  </ul>
</nav>
        <div class="container mt-4 pt-4 border text-Center">
		  
		  <!-- Search Bar -->
		  <form method="GET">
				<div class="input-group mb-3">
					<input type="text" name="searchtxt" class="form-control" placeholder="Search">
				<div class="input-group-append">
				<button class="btn btn-success" type="submit"><i class='fas fa-search'></i></button>  
				</div>
				</form>
			    </div>
			
	      <!-- Search results -->
		  <div class="container border mb-3">
			<?php
				$txt = $_GET['searchtxt'];
				if($txt){
				
				$qrr = "SELECT * FROM mynotes WHERE id='$id' && note_name like '%$txt%'";
				$data = mysqli_query($con,$qrr);
				$row_count = mysqli_num_rows($data);
				if($row_count>0){
				while($rows = mysqli_fetch_assoc($data)){
					echo "<div class='container border mt-3 mb-3 text-left'>";
					echo "<a href='view_notes_t.php?note=".$rows['note_name']."'><b style='font-size: 25px;'>" . $rows['note_name'] . "</b></a>";
					$qrr1 = "SELECT * FROM users WHERE id='$id' && type='teacher'";
					$data1 = mysqli_query($con,$qrr1);
					$row1 = mysqli_fetch_assoc($data1);
					echo "<a href='#' data-toggle='modal' data-target='#ShareNotes' id='".$rows['note_name']."~".$rows['id']."' class='btn text-right sharebtn'><i class='fas fa-share-alt'></i></a><br>";
					echo "Author:-" . $row1['name'];
					echo "</div>";
				}
				}else{
					echo "<h3>No data found!</h3>";
				}
				
				}
				?>
		  </div>
		  
		  
		  </div>
        </div>
		
<!-- Share notes Modal -->
<div class="modal" id="ShareNotes">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Share Notes via link</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
		<div class="input-group mb-3">
		<input type='text' id="sharelink" class='form-control'></input>
  			<div class="input-group-append">
			  <button type='button' id='copytxt' class='btn btn-info' data-toggle="popover" title="Link copied!" data-content="press Crtl + V to pest"><i class='fa fa-copy'></i></button>
  			</div>
			</div>
			<a href="whatsapp://send?text=This is WhatsApp sharing example using link"  data-action="share/whatsapp/share"  
        target="_blank" class="btn fa fa-whatsapp" style="font-size:36px"></a>
		<a href="whatsapp://send?text=This is WhatsApp sharing example using link"  data-action="share/whatsapp/share"  
        target="_blank" class="btn btn-primary fab fa-facebook-messenger" style="font-size:36px"> </a>
		<a href="#"  class="btn fab fa fa-twitter" style="font-size:36px"></a>
		<a href="#"  class="btn fa fa-linkedin" style="font-size:36px"> </a>
		<a href="#"  class="btn fa fa-instagram" style="font-size:36px"> </a>
		<a href="#"  class="btn fa fa-snapchat-ghost" style="font-size:36px"> </a>
		  
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

</body>
</html>