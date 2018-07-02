<?php
		include 'connection.php';
		$cityid=$_POST["city"];
		$resval=$_POST["res"];
		
	if(isset($_POST["city"]) && isset($_POST["res"])){
		$output='';
		
		$query="select  restaurants.name,restaurants.id,cities.name,restaurants.name,common.images,common.Address from restaurants inner join common on restaurants.id=common.restauid inner join cities on common.cityid=cities.id
	where cities.id='".$_POST["city"]."' and restaurants.name='".$_POST["res"]."'";	
		$result=mysqli_query($connect,$query);
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				$address= $row["Address"];
				$resid= $row["id"];
				$output.='<div class="col-6 col-md-4">';
				$output.='<div class="card-group">';
				$output.='<div class="card">';
				$output.='<a href="showrest.php?'.htmlentities('cityid='.urlencode($cityid).' & resid='.urlencode($resid).' & address='.urlencode($address)).'">';
				$output.='<img class="card-img-top" src="images/'.$row["images"].'" height="214" width="360" alt="Card image cap">';
				$output.='<div class="card-body">';
				$output.='<h5 class="card-title">'.$row["name"].'</h5>';
				$output.='<p class="card-text">Location:'.$row["Address"].'</p>';
				$output.='</div>';
				$output.='</a>';
				$output.='</div>';
				$output.='</div>';
				$output.='</div>';
			}
		}else{
			$output.='<li>restaurant not found!</li>';
		}
		$output .='</ul>';
		echo $output;
	}

?>