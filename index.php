
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="css/jquery-3.3.1.min.js"></script>
	
<script>	
			$(document).ready(function(){
				$('#inputcity').change(function(){
					var cityid=$(this).val();
					if(cityid != ''){
						$.ajax({
							url:"fetchcity.php",
							method:"post",
							data:{cityid:cityid},
							success:function(data){
								$('#inputres').val("");
								$('#reslist').hide();
								$('#reslist').html(data);
								
							}
						});
					}
				});
				
			});

			$(document).ready(function(){
				$('#inputres').keyup(function(){
					var tbvalue=$(this).val();
					var cityid=$('#inputcity').val();
					if(tbvalue != ''){
						$.ajax({
							url:"restaurantsearch.php",
							method:"post",
							data:{tbvalue:tbvalue,cityid:cityid},
							success:function(data){
								$('#reslist').fadeIn();
								$('#reslist').html(data);
							}
						});
					}
				});
				
				
				$(document).on('click','li',function(){
					$('#inputres').val($(this).text());
					
					var city=$('#inputcity').val();
					var res=$('#inputres').val();
					$('#reslist').fadeOut();
						$.ajax({
							url:"fetchrest.php",
							method:"post",
							data:{city:city,res:res},
							success:function(data){
								$('#showrestaurants').html(data);
							}
						});
					
				});
			});
			
			
			
</script>

</head>
<body>

					
	
		<div class="container">
				<form>
				  <div class="form-row">
					<div class="form-group col-md-4">
					  <label for="inputcity" >city</label>
					  <select id="inputcity" name="city" class="form-control">
						<option value="" selected>select city</option>
						<?php echo load_city(); ?>
					  </select>
					</div>
					<div class="form-group col-md-6">
					  <label for="inputres" >restaurants</label>
					  <input type="text" class="form-control" id="inputres" placeholder="Enter name of the Resturant">
					  <div id="reslist"></div>
					</div>
				  </div>
						
				</form>
			
		</div>	
			
			
	<div class="container">
		<div class="row" id='showrestaurants'>
			
		</div>
	</div>
	
				
				
				
				
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   
   
   <?php
	function load_city(){
				include 'connection.php';
				$outpu='';
				$query="select * from cities order by name";
				$result=mysqli_query($connect,$query);
					if(mysqli_num_rows($result)>0){
						while($row=mysqli_fetch_assoc($result)){
							$output.='<option value="'.$row["id"].'">'.$row["name"].'</option>';
						}
					}
					return $output;
			}
			
	
   ?>
 
</body>
</html>