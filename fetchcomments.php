<?php
include 'connection.php';
	
		$cityid = $_POST['cityid'];
		$resid = $_POST['resid'];
		$address = $_POST['address'];
		
		
		$output='';
		$query="select comments.id,comments.personname,comments.comment,comments.date from comments inner join common on 
	common.restauid=comments.commrestid where comments.commcityid='".$cityid."' and comments.commrestid='".$resid."'
    and parentcommid='0' and common.Address='".$address."'";
		$result=mysqli_query($connect,$query);
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				$output .= '
					 <div class="panel panel-default">
					  <div class="panel-heading">By <b>'.$row["personname"].'</b> on <i>'.$row["date"].'</i></div>
					  <div class="panel-body">'.$row["comment"].'</div>
					  <div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["id"].'">Reply</button></div>
					 </div>
					 ';
					 $output .= get_reply($connect, $row["id"]);
			}
		}	
			echo $output;
		
		
	

	function get_reply($connect,$parent_id=0,$marginleft=0){
		$cityid = $_POST['cityid'];
		$resid = $_POST['resid'];
		$address = $_POST['address'];
		$query="select comments.id,comments.personname,comments.comment,comments.date from comments inner join common on 
	common.restauid=comments.commrestid where comments.commcityid='".$cityid."' and comments.commrestid='".$resid."'
    and parentcommid='".$parent_id."' and common.Address='".$address."'";
		$result=mysqli_query($connect,$query);
		$output='';
		if($parent_id==0){
			$marginleft=0;
		}else{
			$marginleft=$marginleft+50;
		}
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				$output .= '
				   <div class="panel panel-default" style="margin-left:'.$marginleft.'px">
					<div class="panel-heading">By <b>'.$row["personname"].'</b> on <i>'.$row["date"].'</i></div>
					<div class="panel-body">'.$row["comment"].'</div>
					<div class="panel-footer" align="right"><button type="button" class="btn btn-default reply" id="'.$row["id"].'">Reply</button></div>
				   </div>
				   ';
				$output .= get_reply($connect, $row["id"], $marginleft);

			}
			
		}
		return $output;
		
	}

?>