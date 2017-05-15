<?php 
	session_start();
	
	if(!isset($_SESSION['id'])){
		header("Location: /Home/LandingPage.php?error=Please Sign In again!");
		die();
	}else{
	
		$name = $_SESSION['name'];
		$date = $_SESSION['date'];
		$color = $_SESSION['color'];
		$photo = $_SESSION['photo'] ;
		$email = $_SESSION['email'];
		$workplace = $_SESSION['workplace'];
		$bio = $_SESSION['bio'];
		$userID= $_SESSION['id'];
	
		$con = mysqli_connect('127.0.0.1','yosifmk123','','tiny');
		
		if(mysqli_connect_errno($con))
			die("Fail to connect to database :".mysqli_connect_error());
					
		$friends_arr = []; // store the friends of the user in this array
		$query = "SELECT * FROM friend WHERE (email1 ='$email' OR email2='$email') AND status =1";
		$result = mysqli_query($con ,$query );
	
		while ($row=mysqli_fetch_array($result)){
			
		if($row['email1'] != $email)
			$friends_arr[] = $row['email1'];
											
		if($row['email2'] != $email)
		$friends_arr[] = $row['email2'];
									 	
				 }
										 

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Tiny Socidia | Home</title>
	
	<link href="dist/toolkit.css" rel="stylesheet">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>
<body class="with-top-navbar">
	<nav class="navbar navbar-toggleable-sm fixed-top navbar-inverse bg-primary app-navbar">
		<button
	      class="navbar-toggler navbar-toggler-right hidden-md-up"
	      type="button"
	      data-toggle="collapse"
	      data-target="#navbarResponsive"
	      aria-controls="navbarResponsive"
	      aria-expanded="false"
	      aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
	  
	    <a class="navbar-brand" href="/Home/home.php?id=<?php echo $userID ?>">
			<img width="149" height="39" src="dist/brand-white1.png" alt="brand">
		    </a>
		
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active"><a class="nav-link" href='/Home/home.php?id=<?php echo $userID ?>'>Home <span class="sr-only">(current)</span></a></li>
				<li class="nav-item"><a class="nav-link" href="profile.php?id=<?php echo $userID ?>">Profile</a></li>
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
	
	<div class="container pt-4">
		<div class="row">
			<div class="col-lg-3">
				<div class="card card-profile mb-4">
					<div class="card-header" style="background-image: url(docs/assets/img/iceland.jpg);"></div>
					
					<div class="card-block text-center"><a href="profile.php?id=<?php echo $userID ?>">
						<img
			              class="card-profile-img"
			              src=<?php   echo $photo?> >
			          
						
						<h6 class="card-title"><a class="text-inherit" href="profile/index.html"><?php echo $name; ?></a></h6>
						
						<p class="mb-4"> <?php echo $bio ?></p>
						
						<ul class="card-menu">
							<li class="card-menu-item"><a href="#userModal" class="text-inherit" data-toggle="modal">
				                Friends
								<h6 class="my-0"><?php echo count($friends_arr);?></h6>
							</a></li>
						</ul>
					</div>
				</div>
				
				<div class="card visible-sm-block visible-md-block visible-lg-block mb-4">
					<div class="card-block">
						<h6 class="mb-3">About</h6>
						
						<ul class="list-unstyled list-spaced">
							<li><span class="text-muted icon icon-calendar mr-3"></span>Born on <span class="text-primary"><?php echo $date?></span>
							<li><span class="text-muted icon icon-briefcase mr-3"></span>Work at <span class="text-primary"><?php echo $workplace?></span>
							<li><span class="text-muted icon icon-brush mr-3"></span>Favorite color is <span style="color:<?php echo $color;?>;"><?php echo $color;?></span></ul>
								</div>
								</div>
								</div>
								
								<div class="col-lg-6">
									<ul class="list-group media-list media-list-stream mb-4">
										<li class="media list-group-item p-4">
											<div class="input-group">
													<textarea name='text' form='postform' class="form-control" placeholder="Message"  rows="4" cols="50"></textarea>
													<form id='postform' action="/helperPages/post.php?id=<?php echo $userID ?>" method="POST"  enctype="multipart/form-data">
													<div class="input-group-btn">
													<input name='selectedFile' type="file" id="selectedFile" accept="image/*" style="display: none;" />
													<button onclick="document.getElementById('selectedFile').click();" style='height:100px;' type="button" class="btn btn-secondary">	<span class="icon icon-camera"></span></button>
												</div>
											</div>
											<button style="margin-top:2%; "type="submit" class="btn btn-md btn-pill btn-primary">Submit</button>
											</form>
											
										</li>
									<?php
									
								
									// //first lets get the friends of the user in an array (declared above)
									
									
									// 	 $length = count($friends_arr);
									// 	 for($i = 0 ; $i < $length ; $i++){
										 	
									// 	 $target_email = $friends_arr[$i];
										 
									// 	$query = "SELECT * FROM post,member WHERE member.email = '$target_email' AND '$target_email' = post.email
									// 	ORDER BY post.date DESC";
										
									// 	 $result = mysqli_query($con ,$query );

									// 	 while ($row=mysqli_fetch_array($result)){
							  	
									// 	$text = $row['content'];
									// 	$profilephoto = $row['profilephoto']; // take the post and display it 
									// 	$filendest = $row['picture'];
									// 	$post_name = $row['name'];
									// 	$id = $row['ID'];
										
										
									// 	$date1 = strtotime($row['date']);
									// 	$date2 = strtotime(date("Y-m-d H:i:s")); // the time now

									// 	$secs = $date2 - $date1;// == <seconds between the two times>
									// 	$days = $secs / 86400;
									// 	$minutes = $secs / 60;
									// 	$hours = $secs / 3600;
									// 	$time ='0 seconds ago';
									// 	if($secs > 60)
									// 	$time = (int)$minutes .' minutes ago';
									// 	if($minutes > 60)
									// 	$time = (int)$hours . ' hours ago';
									// 	if($hours > 24)
									// 	$time = (int)$days . ' days ago ';
							
										
									// 	$post = '
									// 				<div id="post">	<li class="media list-group-item p-4">
									// 				<img class="media-object d-flex align-self-start mr-3" src='.$profilephoto.'>
									// 				<div class="media-body"> <div class="media-heading"><small class="float-right text-muted">'.$time.'</small>
    					// 						    <a href = "profile.php?id='.$userID.'&target='.$id.'";><h6>'.$post_name.'</h6></div></a>
									// 				<h4>'.$text.'</h4> <div class="media-body-inline-grid" data-grid="images">
									// 				<div style="display: none">	 ';
											
        	// 								 if($filendest == '')
         //   										$post = $post . '</div> </div> </div> </div>';
         //   								 else
         //   										$post = $post . '<img data-action="zoom" data-width="1050" data-height="700" src='.$filendest.'>	</div> </div> </div> </div>';
            										
    					// 		 echo $post;
							  //}
							
									// 	 }
									
									
									
									
									
									// ========================================================================================================================================
									
									
								
									//first lets get the friends of the user in an array (declared above)
									$friends_arr[] = $email;
										$posts = [] ;

										 $length = count($friends_arr);

										 for($i = 0 ; $i < $length ; $i++){
										 	
										 $target_email = $friends_arr[$i];
										 
										$query = "SELECT * FROM post,member WHERE member.email = '$target_email' AND '$target_email' = post.email
										ORDER BY post.date DESC";
										
										 $result = mysqli_query($con ,$query );

										 while ($row=mysqli_fetch_array($result)){
							  				$posts[] = $row;
										 }
										 }
										 
										function sortByOrder($a, $b) {
												$date1 = strtotime($a['date']);
												$date2 = strtotime($b['date']);
    											return $date2 - $date1;
											}

											usort($posts, 'sortByOrder');			// sorting the array based on the date
	    								
										  $length = count($posts);
										  for($i=0 ; $i<$length ; $i++){
										$text = $posts[$i]['content'];
										$profilephoto = $posts[$i]['profilephoto']; // take the post and display it 
										$filendest = $posts[$i]['picture'];
										$post_name = $posts[$i]['name'];
										$id = $posts[$i]['ID'];
										
										
										$date1 = strtotime($posts[$i]['date']);
										$date2 = strtotime(date("Y-m-d H:i:s")); // the time now

										$secs = $date2 - $date1;// == <seconds between the two times>
										$days = $secs / 86400;
										$minutes = $secs / 60;
										$hours = $secs / 3600;
										$time = $secs.' seconds ago';
										if($secs > 60)
										$time = (int)$minutes .' minutes ago';
										if($minutes > 60)
										$time = (int)$hours . ' hours ago';
										if($hours > 24)
										$time = (int)$days . ' days ago ';
							
										
										$post = '
													<div id="post">	<li class="media list-group-item p-4">
													<img class="media-object d-flex align-self-start mr-3" src='.$profilephoto.'>
													<div class="media-body"> <div class="media-heading"><small class="float-right text-muted">'.$time.'</small>
    											    <a href = "profile.php?id='.$userID.'&target='.$id.'";><h6>'.$post_name.'</h6></div></a>
													<h4>'.$text.'</h4> <div class="media-body-inline-grid" data-grid="images">
													<div style="display: none">	 ';
											
        									 if($filendest == '')
            										$post = $post . '</div> </div> </div> </div>';
            								 else
            										$post = $post . '<img data-action="zoom" data-width="1050" data-height="700" src='.$filendest.'>	</div> </div> </div> </div>';
            										
    							 echo $post;
							  }
							
										 
									?>
									
									</ul>
								</div>
								
								<div class="col-lg-3">
									<div class="card mb-4 hidden-md-down">
										<div class="card-block">
											<h6 class="mb-3">Friendship Requests</h6>
													<?php
													
													$query = "SELECT email1 FROM friend WHERE email2 ='$email' AND status = 2";
							      					$result = mysqli_query($con ,$query );
							      					
													if(mysqli_num_rows($result) >0){
													 while ($row=mysqli_fetch_array($result)){
													 	$target_email = $row['email1'];
													 	
														$query = "SELECT * FROM member WHERE email='$target_email'";
														$result = mysqli_query($con,$query);
													 	 while ($row=mysqli_fetch_array($result)){
													 	 	$photo = $row['profilephoto'];
													 	 	$id= $row['ID'];
													 		echo '
													 		<br>
													 		<br>
													 			
													 				<div class="card-block text-center">
															<a href=profile.php?id='.$userID.'&target='.$id.' >
															<img class="card-profile-img" src='.$photo.'></a>
															<div class="media-body"> <div class="media-heading">
    											    		<h6><a href=profile.php?id='.$userID.'&target='.$id.'>'.$row['name'].'</a></h6></div></div></div>
    											    		
													 		<form name="acceptRejectForm" id="acceptRejectForm" action="/helperPages/friendActions.php?id='.$userID.'&target='.$id.'" method="POST"  enctype="multipart/form-data">	
													 		<button value="accept" name="accept" class="btn btn-outline-success btn-sm"><span class="icon icon-check"></span> Accept</button>
					        	                    		<button value="reject" name="reject" class="btn btn-outline-warning btn-sm"><span class="icon icon-circle-with-cross"></span> Reject</button>
					        	                    		</form>';
													 	 }
													 }
													 
													 }else{
													 echo '<p> You have no pending friendship requests :(';
													 }
													?>

										</div>
									</div>
									<div class="card card-link-list text-center">
										<div class="card-block">© 2017 SWE381 Tiny Socidia
									          <a href="#">KSU</a>
									          <a href="#">Yosif</a>
									          <a href="#">Rayan</a>
									          <a href="#">KSU</a>
									          <a href="#">Yosif</a>
									          <a href="#">Rayan</a>
									          <a href="#">KSU</a>
								  	          <a href="#">Yosif</a>
								  	          <a href="#">Rayan</a>
								  	          <a href="#">KSU</a>
								  	          <a href="#">Yosif</a>
								  	          <a href="#">Rayan</a>
								  	          <a href="#">KSU</a>
									          <a href="#">Yosif</a>
									          <a href="#">Rayan</a></div>
									</div>
								</div>
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