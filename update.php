<?php
        include("connection.php");
        $id = $_GET['id'];
        $email = $_GET['emailtxt'];
        $type = $_GET['type'];
		$name = $_GET['name'];
		$curr_date = date('Y-m-d');
		$curr_time = date("g:i a");
		$qrr = "UPDATE users SET email='$email',name='$name' WHERE id='$id' && type='$type'";
		$data = mysqli_query($con,$qrr);
		if(!$data){
			echo "false";
		}else{
            echo "true";
        }
?>