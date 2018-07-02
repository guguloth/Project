<?php
	include 'connection.php';
	$val=$_POST['cityid'];
	if(isset($_POST["tbvalue"])){
		$output='';
		$query="select distinct restaurants.name,common.cityid from restaurants inner join common on restaurants.id=common.restauid where common.cityid=$val
					and restaurants.name like '%".$_POST["tbvalue"]."%'";
		$result=mysqli_query($connect,$query);
		$output='<ul class="list-unstyled">';
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				$output.='<li>'.$row["name"].'</li>';
			}
		}else{
			$output.='<li>restaurant not found!</li>';
		}
		$output .='</ul>';
		echo $output;
	}

?>

