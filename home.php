<?php
session_start();
error_reporting(0);
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
        <script src="js/update_pro.js"></script>
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
      <a class="dropdown-item text-warning" href="#" data-toggle="modal" data-target="#editprofile">Edit Profile</a>
      <a class="dropdown-item text-danger" href="logout.php">Logout</a>
    </div>
  </li>
<br>
  </ul>
</nav>


<div class="container-fluid mt-3 border">
<div class="row">
<div class="col-lg-4 border text-center">
<h3>My Notes</h3>
<div class="container mt-4 pt-4 mb-4 pb-4">
          <?php
            	$qrr="SELECT * FROM mynotes WHERE id='$id'";
              $data=mysqli_query($con,$qrr);
              $rows = mysqli_num_rows($data);
              if($rows<1){
                  echo "<p class='text-secondary'>No notes Available!</p>";
              }else{
			  echo "<ul class='list-group'>";
			  while($fdata = mysqli_fetch_assoc($data)){
				  echo "<a href='edit_notes.php?note=" .$fdata['note_name']. "'
						class='list-group-item list-group-item-action flex-column align-items-start'><div class='d-flex w-100 justify-content-between'><h6>" . $fdata['note_name'] ;
					if($fdata['status'] == "published"){
						echo " <span class='badge bg-success badge-primary badge-pill'>Published!</span></h6>";
					}else{
						echo " <span class='badge bg-danger'>not-published!</span></h6><small>
    </button></small>";
					}
					echo "</div></a>";
			  }
			  echo "</ul>";
              }

          ?>
		  
		  </div>
</div>
<div class="col-lg-4 border">
<div class="row">
<div class="col-xs-12 col-sm-12 col-lg-12 mt-2">
   <a href="c_notes.php" class="btn btn-primary btn-lg btn-block"><i class='fas fa-book-medical'></i>
   Create Notes</a>
</div>
<!-- <div class="col-xs-12 col-sm-12 col-lg-6 mt-2">
   <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#mynotes"><i class='fas fa-book-reader'></i>
   My Notes</button>
   </div> -->
   
   <div class="col-xs-12 col-sm-12 col-lg-12 mt-2">
   <a href="#" data-toggle="modal" data-target="#profileinfo" class="btn btn-primary btn-lg btn-block"><i class="material-icons" >person</i>
   Profile</a>
   </div>
   <div class="col-xs-12 col-sm-12 col-lg-12 mt-2">
   <a href="t_feedbacks.php" class="btn btn-primary btn-lg btn-block"><i class="material-icons">feedback</i>
   Feedbacks
   <?php
      $temp_qrr="SELECT * FROM feedbacks WHERE teacher_id='$id' && read_noti='NO'";
      $data = mysqli_query($con,$temp_qrr);
      $rows = mysqli_num_rows($data);
      if($rows>0){
        echo "<span class='badge badge-light'>". $rows . "</span>";
      }
   ?>
   </a>
   </div>
   <!--<div class="col-xs-12 col-sm-12 col-lg-6 mt-2">
   <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#editprofile"><i class='fas fa-user-edit'></i>
   Edit Profile</button>
    </div> -->
	</div>
  </div>
  <div class="col-lg-4 border">
  <!-- Search Bar -->
  <form method="GET" class="text-center">
  <h3>Search notes</h3>
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
				$qrr = "SELECT * FROM mynotes WHERE note_name like '%$txt%'";
				$data = mysqli_query($con,$qrr);
				$row_count = mysqli_num_rows($data);
				if($row_count>0){
				while($rows = mysqli_fetch_assoc($data)){
					echo "<div class='container border mt-3 mb-3 text-left'>";
					echo "<a href='view_notes_t.php?note=".$rows['note_name']."' style='text-decoration: none;'><b style='font-size: 25px;'>" . $rows['note_name'] . "</b></a>";
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
       

<!-- Modals -->
 <!-- Profile Modal -->
  <div class="modal fade" id="profileinfo">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title">Profile Information</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- body -->
        <div class="modal-body">
          <div class="container mt-4 pt-4 border text-left">
				<h3>User id: <b><?php echo $id ?></b></h3><br>
			<h2>Name: <b><?php $id = $_SESSION['id'];
			include("connection.php");
			$qrr="SELECT * FROM users WHERE id='$id' && type='teacher'";
			$data=mysqli_query($con,$qrr);
			$fdata = mysqli_fetch_assoc($data);
			echo $fdata['name']; ?></b></h2><br>
			<h2>Gender: <b><?php echo $fdata['gender'] ?></b></h2><br>
			<h2>Email: <b><?php echo $fdata['email'] ?></b></h2><br>
			</div>
        </div>
        
        <!-- footer -->
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#editprofile">Edit</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>


<!-- Edit Profile Modal -->
  <div class="modal fade" id="editprofile">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title">Profile Information</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- body -->
        <div class="modal-body">
          <div class="container mt-4 pt-4 border text-left">
				<h3>User id: <input type="text" id="useridtxt" value="<?php echo $id ?>" disabled></input></h3><br>
			<h2>Name: <input type="text" id="nametxt" value="<?php $id = $_SESSION['id'];
			include("connection.php");
			$qrr="SELECT * FROM users WHERE id='$id' && type='teacher'";
			$data=mysqli_query($con,$qrr);
			$fdata = mysqli_fetch_assoc($data);
			echo $fdata['name']; ?>" ></input></h2><br>
			<h2>Gender: <b><?php echo $fdata['gender'] ?></b></h2><br>
			<h2>Email: <input type="text" id="emailtxt" value="<?php echo $fdata['email'] ?>"></input>
      <input type="hidden" id="typetxt" value="teacher"> 
      </h2><br>
			</div>
        </div>
        
        <!-- footer -->
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#resetp">Reset password</button>
          <button type="button" id="updatepro" class="btn btn-info" data-dismiss="modal">Update</button>
        </div>
        
      </div>
    </div>
  </div>



<!-- Reset password Modal -->
<div class="modal fade" id="resetp">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title">Reset Password</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- body -->
        <div class="modal-body">
          <div class="container mt-4 pt-4 border text-left">
				<input type="text" class="form-control" placeholder="Old password"><br>
			<input type="text" class="form-control" placeholder="New password"><br>
      <input type="button" value="Submit" class="btn btn-info">
			</div>
        </div>
        
        <!-- footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>



<!-- Notes Modal -->
<div class="modal fade" id="mynotes">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
      
        <!-- Header -->
        <div class="modal-header">
          <h4 class="modal-title">My Notes</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- body -->
        <div class="modal-body">
          <div class="container mt-4 pt-4 mb-4 pb-4">
          <?php
            	$qrr="SELECT * FROM mynotes WHERE id='$id'";
              $data=mysqli_query($con,$qrr);
              $rows = mysqli_num_rows($data);
              if($rows<1){
                  echo "<p class='text-secondary'>No notes Available!</p>";
              }else{
			  echo "<ul class='list-group'>";
			  while($fdata = mysqli_fetch_assoc($data)){
				  echo "<a href='edit_notes.php?note=" .$fdata['note_name']. "'
						class='list-group-item list-group-item-action flex-column align-items-start'><div class='d-flex w-100 justify-content-between'><h6>" . $fdata['note_name'] ;
					if($fdata['status'] == "published"){
						echo " <span class='badge bg-success badge-primary badge-pill'>Published!</span></h6>";
					}else{
						echo " <span class='badge bg-danger'>not-published!</span></h6><small>
    </button></small>";
					}
					echo "</div></a>";
			  }
			  echo "</ul>";
              }

          ?>
		  
		  </div>
        </div>
        
        <!-- footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>


	   
        </body>
        
</html>