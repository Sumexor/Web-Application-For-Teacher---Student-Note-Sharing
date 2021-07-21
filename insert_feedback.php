<?php
		date_default_timezone_set('Asia/Kolkata');
        include("connection.php");
        $id = $_GET['id'];
        $teacher = $_GET['teacher'];
        $note_title = $_GET['note'];
		$feedback = $_GET['feedback'];
		$curr_date = date('Y-m-d');
		$curr_time = date("g:i a");
		$qrr = "INSERT INTO feedbacks VALUES('$id','$feedback','$curr_time','$curr_date','$note_title','NO','$teacher','-')";
		$data = mysqli_query($con,$qrr);
		if(!$data){
			echo "false";
		}else{
            echo "true";
        }
?>