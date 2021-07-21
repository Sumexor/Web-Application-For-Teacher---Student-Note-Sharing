<!DOCTYPE html>
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
?>

<html>
    <head><meta name="charset" content="utf-8">
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
	$qrr="SELECT * FROM users WHERE id='$id' && type='student'";
	$data=mysqli_query($con,$qrr);
	$fdata = mysqli_fetch_assoc($data);
	echo $fdata['name']; ?></a>
    <div class="dropdown-menu bg-info">
      <a class="dropdown-item text-warning" href="s_profile.php">Profile</a>
      <a class="dropdown-item text-danger" href="logout.php">Logout</a>
    </div>
  </li>
<br>
  </ul>
</nav>

<div class="container">
<div class="row">
<div class="col-sm-3 col-lg-3 col-md-3 mt-4 pt-4 border text-Center" >
<h3 class="mb-5">My Notes List</h3>
<?php
$qrr1 = "SELECT * FROM fav_notes WHERE student_id='$id'";
$data1 = mysqli_query($con,$qrr1);
$row_count1 = mysqli_num_rows($data1);
if($row_count1>0){
	echo "<div class='list-group mb-2'><div class='border pt-2 pl-1 pr-1' id='noteslist'>";
	$index=1;
	while($row_data12 = mysqli_fetch_assoc($data1)){
		echo "<div id='listitem'>
		<div class='input-group mb-3' id='".str_replace(" ","_",$row_data12['fav_notes_name'])."~".str_replace(" ","_",$row_data12['teacher_id'])."'>
      <div class='input-group-prepend'>
        <div class='input-group-text'>
          ".$index."
        </div>
      </div>
      <a href='view_notes_s.php?note=".$row_data12['fav_notes_name']."&teacher=".$row_data12['teacher_id']."' class='form-control'>".$row_data12['fav_notes_name']."</a>
    </div>
		</div>";
		$index=$index+1;
	}
	echo "</div></div>";
	
  }
  else{
    echo "<div id='noteslist'><h5 class='text-muted'>No Notes found!</h5></div>";
    }
?>
</div>
<div class="col-sm-9 col-lg-9 col-md-9 mt-4 pt-4 pr-2 border text-center" >
			
		  <!-- Search Bar -->
		  <form method="GET">
				<div class="input-group mb-3">
				<input type="text" name="searchtxt" class="form-control" placeholder="Search">
				<div class="input-group-append">
				<button class="btn btn-success" type="submit"><i class='fas fa-search'></i></button>
				</div>
				</div>
		</form>
			    
			
	    <!-- Search results -->
		<div class="container border mb-3">
			<?php
				$txt = $_GET['searchtxt'];
				if($txt){
				$qrr = "SELECT * FROM mynotes WHERE note_name like '%$txt%'";
				$data = mysqli_query($con,$qrr);
				$row_count = mysqli_num_rows($data);
				if($row_count>0){
				while($rows = mysqli_fetch_assoc($data)){
					echo "<div class='container border mt-3 mb-3 text-left'>";
					echo "<a href='view_notes_s.php?note=".$rows['note_name']."&teacher=".$rows['id']."' style='text-decoration: none;'><b style='font-size: 25px;'>" . $rows['note_name'] . "</b></a>";
          			$qry = "SELECT * FROM fav_notes WHERE student_id='$id' && fav_notes_name='$rows[note_name]' && teacher_id='$rows[id]'";
					$data12 = mysqli_query($con,$qry);
					$rows12 = mysqli_num_rows($data12);
					if($rows12>0){
						echo " <a href='#' id='".$rows['note_name']."~".$rows['id']."' class='btn text-right adbn'><i class='material-icons'>playlist_add_check</i></a>";
					}else{
						echo " <a href='#' id='".$rows['note_name']."~".$rows['id']."' class='btn text-right adbn'><i class='material-icons'>playlist_add</i></a>";
					}
					echo "<a href='#' data-toggle='modal' data-target='#ShareNotes' id='".$rows['note_name']."~".$rows['id']."' class='btn text-right sharebtn'><i class='fas fa-share-alt'></i></a><br>";
					$qrr1 = "SELECT * FROM users WHERE id='$rows[id]' && type='teacher'";
					$data1 = mysqli_query($con,$qrr1);
					$row1 = mysqli_fetch_assoc($data1);
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