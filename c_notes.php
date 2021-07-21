<?php
session_start();
$id=$_SESSION['id'];
include("connection.php");
error_reporting(0);
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
		<style>
		.note-placeholder {
  position: absolute;
  top: 20%;
  left: 5%;
  font-size: 2rem;
  color: #e4e5e7;
  pointer-events: none;
}

/*Toolbar panel*/

.note-editor .note-toolbar {
  background: #f0f0f1;
  border-bottom: 1px solid #c2cad8;
  -webkit-box-shadow: 0 0 4px 0 rgba(0, 0, 0, 0.14), 0 3px 4px 0 rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
  box-shadow: 0 0 4px 0 rgba(0, 0, 0, 0.14), 0 3px 4px 0 rgba(0, 0, 0, 0.12), 0 1px 5px 0 rgba(0, 0, 0, 0.2);
}

/*Buttons from toolbar*/

.summernote .btn-group, .popover-content .btn-group {
  background: transparent;
  -webkit-box-shadow: none;
  box-shadow: none;
}

.note-popover {
  background: #f0f0f1!important;
}

.summernote .btn, .note-btn {
  color: rgba(0, 0, 0, .54)!important;
  background-color: transparent!important;
  padding: 6px 12px;
  font-size: 14px;
  line-height: 1.42857;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  -webkit-box-shadow: none;
  box-shadow: none;
}

.summernote .dropdown-toggle:after {
  vertical-align: middle;
}

.note-editor.card {
  -webkit-box-shadow: none;
  box-shadow: none;
  border-radius: 2px;
}

/* Border of the Summernote textarea */

.note-editor.note-frame {
  border: 1px solid rgba(0, 0, 0, .14);
}

/* Padding of the text in textarea */

.note-editor.note-frame .note-editing-area .note-editable {
  padding-top: 1rem;
}
		</style>
	
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


<div class="container mt-4 pb-4 pt-4 border text-center">
<form method="post" class="summernote">
		  <input type="text" placeholder="Note Title" name="title" id="title" class="form-control mb-5" required>
          <textarea id="my-summernote" name="editordata" id="data" required></textarea>
		  <input type="submit" value="Submit" name="submit" class="btn btn-success mt-3"></input>
		  <input type="submit" value="Save" name="save" class="btn btn-info mt-3"></input>
</form>
       
</div>
       
	   
    </body>

<?php
	if(isset($_POST['submit'])){
    $ndata = $_POST['editordata'];
    $title =$_POST['title'];
    if($ndata){
      $qrr="SELECT * FROM mynotes WHERE note_name='$title' && id='$id'";
	$data=mysqli_query($con,$qrr);
      $rows = mysqli_num_rows($data);
      if($rows>0){
        echo "<script>alert('Similar title notes available! please change name.');</script>";
      }else{
        $stat = "published";
        $qrr = "INSERT INTO mynotes VALUES('$id','$title','$ndata','$stat')";
		mysqli_query($con,$qrr);
		echo "<script type='text/javascript'>alert('Published!');  </script>";
		echo "<script type='text/javascript'>
		window.location.href = 'home.php';
		</script>";
      }
    }
	}elseif(isset($_POST['save'])){
		$ndata = $_POST['editordata'];
		$title =$_POST['title'];
	if($ndata){
		$qrr="SELECT * FROM mynotes WHERE note_name='$title' && id='$id'";
		$data=mysqli_query($con,$qrr);
		$rows = mysqli_num_rows($data);
		if($rows>0){
			echo "<script type='text/javascript'>alert('Same name notes already exist!');  </script>";
		}else{
        $stat = "non-public";
        $qrr1 = "INSERT INTO mynotes VALUES('$id','$title','$ndata','$stat')";
		mysqli_query($con,$qrr1);
		echo "<script type='text/javascript'>alert('Saved!');  </script>";
		echo "<script type='text/javascript'>
		window.location.href = 'home.php';
		</script>";
      }
    }
	}
    
?>
<script>
$('#my-summernote').summernote({
  minHeight: 200,
  placeholder: 'Write here ...',
  focus: false,
  airMode: false,
  fontNames: ['Roboto', 'Calibri', 'Times New Roman', 'Arial'],
  fontNamesIgnoreCheck: ['Roboto', 'Calibri'],
  dialogsInBody: true,
  dialogsFade: true,
  disableDragAndDrop: false,
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['para', ['style', 'ul', 'ol', 'paragraph']],
    ['fontsize', ['fontsize']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['height', ['height']],
    ['misc', ['undo', 'redo', 'print', 'help', 'fullscreen']]
  ],
  popover: {
    air: [
      ['color', ['color']],
      ['font', ['bold', 'underline', 'clear']]
    ]
  },
  print: {
    //'stylesheetUrl': 'url_of_stylesheet_for_printing'
  }
});

</script>


</html>