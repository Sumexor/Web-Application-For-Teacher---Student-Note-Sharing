<?php
		date_default_timezone_set('Asia/Kolkata');
        include("connection.php");
        $student = $_GET['student'];
        $teacher = $_GET['teacher'];
        $note_title = $_GET['note'];
		$reply = $_GET['reply'];
		$curr_date = date('Y-m-d');
		$curr_time = date("g:i a");
		$qrr = "UPDATE feedbacks SET reply='$reply' WHERE student_id='$student' && teacher_id='$teacher' && note_name='$note_title'";
		$data = mysqli_query($con,$qrr);
		if(!$data){
			echo "false";
		}else{
            echo "true";
        }
?>