<?php
	include 'connection.php';
	
	if(isset($_POST["cityid"])){
		$output='';
		$query="select * from cities where cityid='".$_POST["cityid"]."' order by name";
		$result=mysqli_query($connect,$query);
		$output='<ul class="list-unstyled">';
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				$output.='<li>'.$row["name"].'</li>';
			}
		}else{
			$output.='<li>Please select city</li>';
		}
		$output .='</ul>';
		echo $output;
	}

?>
