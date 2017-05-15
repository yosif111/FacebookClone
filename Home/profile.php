<?php 

	session_start();
		$userID = $_SESSION['id'];
		$name = $_SESSION['name'];
		$date = $_SESSION['date'];
		$color = $_SESSION['color'];
		$photo = $_SESSION['photo'] ;
		$email = $_SESSION['email'];
		$workplace = $_SESSION['workplace'];
		$bio = $_SESSION['bio'];
	
	$con = mysqli_connect('127.0.0.1','yosifmk123','','tiny');
		if(mysqli_connect_errno($con))
			die("Fail to connect to database :".mysqli_connect_error());
			
			
	if(!isset($_SESSION['id'])){
		header("Location: /Home/LandingPage.php?error=Please Sign In again!");
		die();
		
	}else if(isset($_GET['target'])) {
			
				$id = $_GET['target'];
				$query = "SELECT * FROM member WHERE ID ='$id'"; // get the target information
				$result = mysqli_query($con ,$query );
				
				if(mysqli_num_rows($result) >0){
				$row=mysqli_fetch_array($result);
				$email = $row['email'];
				$name = $row['name'];
				$date = $row['birth_date'];
				$photo = $row['profilephoto'];
				$color = $row['color'];
				$workplace= $row['workplace'];
				$bio = $row['bio'];

				}
	}
				$friends_arr= []; // getting the friends of this person
				
			    $query = "SELECT * FROM friend WHERE status =1 AND (email1 ='$email' OR email2 ='$email')";
			    $result = mysqli_query($con ,$query );
		        
			    while ($row=mysqli_fetch_array($result)){
			       	
			       		if($row['email1'] != $email)
							$friends_arr[] = $row['email1'];
											
						if($row['email2'] != $email)
							$friends_arr[] = $row['email2'];
			       	}
		?>



<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Tiny Socidia | Profile</title>
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
	<link href="dist/toolkit.css" rel="stylesheet">
	
</head>
<body>
	<nav class="navbar navbar-toggleable-sm fixed-top navbar-inverse bg-primary app-navbar">
		<!--hamberger button-->
		<button
	      class="navbar-toggler navbar-toggler-right hidden-md-up"
	      type="button"
	      data-toggle="collapse"
	      data-target="#navbarResponsive"
	      aria-controls="navbarResponsive" 
	      aria-expanded="false"
	      aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
	     </button>
	  
	    <a class="navbar-brand" href="home.php?id=<?php echo $userID ?>">
		<img width="149" height="39" src="dist/brand-white1.png" alt="brand"> 
		</a>
		
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item "><a class="nav-link" href="home.php?id=<?php echo $userID ?>">Home <span class="sr-only">(current)</span></a></li>
				<li class="nav-item active"><a class="nav-link" href="profile.php?id=<?php echo $userID ?>">Profile</a></li>
				<li class="nav-item"><a class="nav-link" href="/Home/editProfile.php?id=<?php echo $userID ?>">Edit</a></li>

			</ul>
			<form class="form-inline float-right hidden-sm-down" action='search.php?id=<?php echo $userID ?>' method='POST'>
      			<input  name='search' style="margin-right:10px;"class="form-control" type="text" data-action="grow" placeholder="Search email or name">
    		</form>
			<ul class="nav navbar-nav float-right " id="js-popoverContent">
				<li class="nav-item"><a class="nav-link" href="/helperPages/logout.php">Logout<i class="fa fa-sign-out" aria-hidden="false"> </i></a> </li>
			</ul>
		</div>
	</nav>
	
	
	<div class="container text-center">
		<div class="profile-header text-center" style="background: linear-gradient(#216B95, #3097D1); ">
			<div class="container-fluid">
				<div class="container-inner">
					<img class="rounded-circle media-object" src=<?php echo $photo?> >
					<h3 class="profile-header-user"><?php echo $name?></h3>
					<p class="profile-header-bio"><?php echo $bio?></p>
				</div>
				
				<ul class="card-menu">
					<li class="card-menu-item"><a href="#userModal" class="text-white " data-toggle="modal">
		                <span class="icon icon-users"></span> Friends
						
						<h6 class="my-0"><?php echo count($friends_arr)?></h6>
					</li>
					<li class="card-menu-item"><a href="#userModal" class="text-white " data-toggle="modal">
		                <span class="icon icon-briefcase"></span> Work at
						
						<h6 class="my-0">	<?php echo $workplace ?> </h6>
					</a></li>
				</ul>
			</div>
			
			<nav class="profile-header-nav">
				<ul class="nav nav-tabs justify-content-center">
					<li class="nav-item"><a class="nav-link ajax-link" href="#" data-id="photos">Photos</a></li>
					<li class="nav-item active"><a class="nav-link ajax-link" href="#" data-id="posts">Posts</a></li>
					<li class="nav-item"><a class="nav-link ajax-link" href="#" data-id="friends">Friends </a></li>
				</ul>
			</nav>
		</div>
		
		<div id="main"></div>
		
		<div id="friends" class="mt-2" style="display: none ;" >
			<div class="row">
				
				<?php
				
		
					$length = count($friends_arr);  // loop through the friends to display
					for($i = 0 ; $i < $length ; $i++){
						
					$target_email = $friends_arr[$i];
					$query = "SELECT * FROM member WHERE email='$target_email'";
					$result = mysqli_query($con ,$query );
			
				while ($row=mysqli_fetch_array($result)){
				    
				    if($row['email'] == $email) // i dont want to display my self.
				        continue;
				    $color = $row['color'];
				    $profilephoto = $row['profilephoto'];
				    $name1 = $row['name'];
				    $bio = $row['bio'];
				    $id1= $row['ID'];
				    $profile = 'profile.php?id='.$userID.'&target='.$id1;
				    
				    $friend = '
				        
				        <div class="col-sm-6">
				    	<div class="card card-profile">
						<div class="card-header" style="background: '.$color.'; "></div>
						
						<div class="card-block text-xs-center">
						<img class="card-profile-img" height =110 width=110 src='.$profilephoto.'>
						<a href='.$profile.'><h5 class="card-title">'.$name1.'</h5></a>
						<p class="mb-4">'.$bio.'</p>
		            	<form name="friendsform" id="friendsform" action="/helperPages/friendActions.php?target='.$id1.'" method="POST"  enctype="multipart/form-data">
						<button name="remove" value="remove" id="remove" class="btn btn-outline-danger btn-sm"><span class="icon icon-remove-user"></span> Remove From Friends</button>
						</form>	</div> </div> </div>';
					
				
				echo $friend;
				
				}
					}
				 
				?>
				
			</div>
		</div>
		
		<div id="posts" style="display: none;" >
			<ul class="media-list media-list-stream mb-3">
				
				<?php
						
					$query = "SELECT * FROM post WHERE email ='$email' ORDER BY date DESC "; // display the user posts
					$result = mysqli_query($con ,$query );

					if(mysqli_num_rows($result) > 0){
						
						 while ($row=mysqli_fetch_array($result)){
							$text = $row['content'];
							if($row['picture'] != ''){
							$filedest = $row['picture'];
							list($width, $height) = getimagesize($filedest);
							}
							
							$date1 = strtotime($row['date']);
							$date2 = strtotime(date("Y-m-d H:i:s")); // the time now

							$secs = $date2 - $date1;// == <seconds between the two times>
							$days = $secs / 86400;
							$minutes = $secs / 60;
							$hours = $secs / 3600;
							$time ='';
							if($secs > 60)
							$time = (int)$minutes .' minutes ago';
							if($minutes > 60)
							$time = (int)$hours . ' hours ago';
							if($hours > 24)
							$time = (int)$days . ' days ago ';
							
							if($width > 1400)
							$width = 1000;
							$post = '	
										<li class="media list-group-item p-4">
										<img class="media-object mr-3 align-self-start" src= '. $photo .'>
					
										<div class="media-body" >
										<div class="media-heading"><small class="float-right text-muted">'.$time.'</small>
							
										<h6>'.$name.'</h6>
										</div>
											<br>
										<h3>'.$text.'</h3>
										<br> 
										<img data-action="zoom" width='.$width.' height='.$height.' src='.$filedest.'>
										</div>
										</li>  ';
										
							echo $post;
							
													 }
							}
		?>
			</ul>
		</div>
		
		<div class="images text-center" id="photos" class="container my-4" data-grid="images" style="display: none;" >
		
			<?php
			
			$query = "SELECT picture FROM post WHERE email ='$email' ORDER BY date DESC "; // display the images of the user
			$result = mysqli_query($con ,$query );
					 
					 
					if(mysqli_num_rows($result) > 0){
						 while ($row=mysqli_fetch_array($result)){
							
							$text = $row['content'];
							$filendest = $row['picture'];
							if($filendest == '')
							continue;
							echo '
			<div>
				<img   data-width="640" data-height="640" data-action="zoom" src='.$filendest.'>
			</div>
			';
						 }
					}
			?>
		</div>
	</div>
    
    <script src="https://code.jquery.com/jquery.min.js"></script>
    <script src="dist/toolkit.js"></script>
    <script src="dist/js/script.js"></script>
    <script src="dist/tether.min.js"></script>
    <script src="dist/toolkit2.js"></script>
    <script src="docs/assets/js/chart.js"></script>
    
  </body>

</html>

