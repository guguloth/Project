<?php
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	include 'connection.php';
		$output="";
							$cityid = intval($_GET['cityid']);
							$resid = intval($_GET['resid']);
							$address = strval($_GET['address']);
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Home restaurants</title>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  	<script src="css/jquery-3.3.1.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <script>
		$(document).ready(function(){
			$('#comment_form').on('submit',function(e){
				e.preventDefault();
				$passvalue={cityid:<?php echo $cityid;?>,
							resid:<?php echo $resid;?>,
							address:'<?php echo $address;?>'
							};
				var data=$(this).serialize()+'&'+$.param($passvalue);
				$.ajax({
					url:"comments.php",
					method:"POST",
					data:data,
					dataType:"json",
					success:function(data){
						if(data.output != ''){
							$('#comment_form')[0].reset();
							$('#comment_message').html(data.output);
							$('#comment_id').val('0');
							fill_comment();
						}
					}
				})
			});
			
			
		fill_comment();
		function fill_comment(){
					var cityid=<?php echo $cityid;?>;
					var resid=<?php echo $resid;?>;
					var address='<?php echo $address;?>';
			$.ajax({
					url:"fetchcomments.php",
					method:"POST",
					data:{cityid:cityid,resid:resid,address:address},
					success:function(data){
							$('#display_comment').html(data);
						}
					
				});
		}
		
		$(document).on('click','.reply',function(){
			var comment_id=$(this).attr("id");
			$('#comment_id').val(comment_id);
			$('#comment_name').focus();
			
		});
		
		
		});
		
		
	</script>

  
 </head>
 <body>
  <br />
  
 <div class="container" style=" padding.bottom="100px">
					<div class="row" id='showrestaurants'>
						<div class="col-12 col-md-12">
  <a href="index.php" class="btn btn-info" >Home</a>
  </div>
  </div>
  </div>
  <?php
		
		$query="select restaurants.name,common.images,common.Address from restaurants inner join common on 
	common.restauid=restaurants.id inner join cities on common.cityid=cities.id where common.cityid='".$cityid."' and common.restauid='".$resid."' and common.Address='".$address."'";
			
		$result=mysqli_query($connect,$query);
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				?>
				<div class="container">
					<div class="row" id='showrestaurants'>
						<div class="col-12 col-md-12">
							<div class="card-group">
								<div class="card">
									<div class="card-header"><h2><?php echo strtoupper($row["name"]); ?></h2></div>
									<img class="card-img-top" src="images/<?php echo $row["images"]; ?>" height="480" width="480" alt="Card image cap">
									<div class="card-body">
										<p class="card-text">Address:<?php echo $row["Address"];?> </p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php }
		}
	
?>
  <h2 Style="padding-left:50px">Comments:</a></h2>
  <br />
  <div class="container">
   <form method="POST" id="comment_form">
    <div class="form-group">
     <input type="text" name="comment_name" id="comment_name" class="form-control" placeholder="Enter Name" />
    </div>
    <div class="form-group">
     <textarea name="comment_content" id="comment_content" class="form-control" placeholder="Enter Comment" rows="5"></textarea>
    </div>
    <div class="form-group">
     <input type="hidden" name="comment_id" id="comment_id" value="0" />
     <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
    </div>
   </form>
   <span id="comment_message"></span>
   <br />
   <div id="display_comment"></div>
  </div>
    
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   
 </body>
</html>