<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include 'connection.php';
		
		$cityid = $_POST['cityid'];
		$resid = $_POST['resid'];
	$output='';
	$comment_name='';
	$comment_content='';
	date_default_timezone_set('Asia/Kolkata');
	$date=date('Y-m-d h-i-s');
	
	
	if(empty($_POST["comment_name"])){
		$output.='<p class="text-danger">Name is requried</p>';
	}else{
		$comment_name=$_POST["comment_name"];
	}
	if(empty($_POST["comment_content"])){
		$output.='<p class="text-danger">Comment is requried</p>';
	}else{
		$comment_content=$_POST["comment_content"];
	}
	
	
	if($output == ''){
		$query="INSERT INTO `project`.`comments` (`parentcommid`, `comment`, `personname`,`date`,commcityid,commrestid) VALUES 
					(?,?,?,?,?,?)";
		$stmt=mysqli_prepare($connect,$query);
			mysqli_stmt_bind_param($stmt, "isssii", $parent_comm_id, $comm, $comm_sender,$date,$cityid,$resid);
			$parent_comm_id=$_POST["comment_id"];
			$comm=$comment_content;
			$comm_sender=$comment_name;
			$date=$date;
			$cityid=$cityid;
			$resid=$resid;
			if(mysqli_stmt_execute($stmt)){
                $output='<label class="text-success">comment posted</label>';
            } else{
                die(mysql_error());
            }
			mysqli_stmt_close($stmt);
	}
	$data=array(
		'output' => $output
	);
	
	echo json_encode($data);
?>