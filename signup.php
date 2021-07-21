<?php
error_reporting(0);
include("connection.php");
?>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="css/signup.css" >
        
        </head>
        
        <body>
            <nav class="navbar navbar-expand-sm bg-info navbar-dark">
                <a class="navbar-brand" href="index.php">MyCampus</a>
</nav>


<div class="container mt-4 pt-4 border text-center bg-light">
    <form method="POST">
        <div id="txtdiv" class="form-group">
	
      
        <input type="text" name="id" id="aname" placeholder="Login id" class="form-control" value="<?php echo $_POST['id'];?>" required>
        </div>
        <div class="was-validated">
            
        <input type="text" name="fname" placeholder="Name" class="form-control mt-2" value="<?php echo $_POST['fname'];?>" required>
     
		<div class="form-group">
        <?php
            if($_POST['gender']){
                $gender = $_POST['gender'];
                if($gender == "male"){
                    echo "<select id='cars' name='gender' class='form-control mt-2' required>
                <option value='male' selected>Male</option>
                <option value='female'>Female</option>
                <option value='transgender'>Transgender</option>
        </select>";
                }elseif($gender == "female"){
                    echo "<select id='cars' name='gender' class='form-control mt-2' required>
                    <option value=''>Gender:</option>
                <option value='male'>Male</option>
                <option value='female' selected>Female</option>
                <option value='transgender'>Transgender</option>
        </select>";
                }else{
                    echo "<select id='cars' name='gender' class='form-control mt-2' required>
                    <option value=''>Gender:</option>
                <option value='male'>Male</option>
                <option value='female'>Female</option>
                <option value='transgender'>Transgender</option>
        </select>";
                }
            }else{
                echo "<select id='cars' name='gender' class='form-control mt-2' required>
                    <option value=''>Gender:</option>
                <option value='male'>Male</option>
                <option value='female'>Female</option>
                <option value='transgender'>Transgender</option>
        </select>";
            }
        ?>
        
      <div class="valid-feedback text-left">Valid.</div>
      <div class="invalid-feedback text-left">Please fill out this field.</div>
      </div>
		
		<div class="form-group">
        <input type="email" name="email" placeholder="Email" class="form-control mt-2" value="<?php echo $_POST['email'];?>" required>
        <div class="valid-feedback text-left">Valid.</div>
      <div class="invalid-feedback text-left">Please fill Email.</div>
      </div>
      
        <div class="form-group">
        <input type="password" name="pass" placeholder="Password" class="form-control mt-2" value="<?php echo $_POST['pass'];?>" required>
        <div class="valid-feedback text-left">Valid.</div>
      <div class="invalid-feedback text-left">Please fill out this field.</div>
      </div>
      <div class="form-group">
        <input type="password" name="repass" class="form-control mt-2" placeholder="Confirm Password" value="<?php echo $_POST['repass'];?>" required>
        <div class="valid-feedback text-left">Valid.</div>
      <div class="invalid-feedback text-left">Please fill out this field.</div>
      </div>
<div class="form-group">
<?php
            if($_POST['type']){
                $gender = $_POST['type'];
                if($gender == "student"){
                    echo "<select name='type' class='form-control mt-2' required>
                <option value='student' selected>Student</option>
                <option value='teacher'>Teacher</option>
        </select>";
                }elseif($gender == "teacher"){
                    echo "<select name='type' class='form-control mt-2' required>
                    <option value='student' >Student</option>
                    <option value='teacher' selected>Teacher</option>
        </select>";
                }else{
                    echo "<select name='type' class='form-control mt-2' required>
                    <option value=''> Signup as: </option>
                    <option value='student' >Student</option>
                    <option value='teacher'>Teacher</option>
        </select>";
                }
            }else{
                echo "<select name='type' class='form-control mt-2' required>
                    <option value=''> Signup as: </option>
                    <option value='student' >Student</option>
                    <option value='teacher'>Teacher</option>
        </select>";
            }
        ?>
        
      <div class="valid-feedback text-left">Valid.</div>
      <div class="invalid-feedback text-left">Please fill out this field.</div>
      </div>      
</div>

<input type="submit" value="Submit" class="btn btn-success block" >
    </form>
    
</div>
            
        </body>
        
</html>

<?php
$id=$_POST['id'];
$pass=$_POST['pass'];
$repass=$_POST['repass'];
$email=$_POST['email'];
$type=$_POST['type'];
$gender = $_POST['gender'];
$name = $_POST['fname'];
if($id){
    $qr="SELECT * FROM users WHERE id='$id'";
    $data=mysqli_query($con,$qr);
if(mysqli_num_rows($data)==1){
    echo("<div class='alert alert-danger alert-dismissible'>
	<button type='button' class='close' data-dismiss='alert'>&times;</button>
    <strong>Warning!</strong> Duplicate User id<a href='#' class='alert-link'>Please change user id and try again!</a>.
  </div>");
}
else{
    $qr="SELECT * FROM users WHERE email='$email'";
    $data=mysqli_query($con,$qr);
    if(mysqli_num_rows($data)==1){
        echo("<div class='alert alert-danger alert-dismissible'>
	<button type='button' class='close' data-dismiss='alert'>&times;</button>
    <strong>Warning!</strong> Duplicate Email <a href='#' class='alert-link'>Please change Email and try again!</a>.
  </div>");
    }else{
    if($type=='teacher'){
        $qrr="INSERT INTO users VALUES('$id','$pass','$email','$gender','$name','teacher')";
        $data=mysqli_query($con,$qrr);
        header("location:index.php");
        }
        else if($type=='student'){
            $qrr="INSERT INTO users VALUES('$id','$pass','$email','$gender','$name','student')";
            $data=mysqli_query($con,$qrr);
            header("location:index.php");
        }
    }
}
}

?>