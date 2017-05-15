<?php 
    session_start();
    
    if(!isset($_SESSION['id'])){
    	header("Location: /Home/LandingPage.php?error=Please Sign In again!");
	    die();
    
   
    
     }else if (!isset($_POST['search'])){
	        $id = $_SESSION['id'];
	    header("Location: /Home/home.php?id=$id");
	    die();
    
     }
    else{
	    
    	$name = $_SESSION['name'];
    	$date = $_SESSION['date'];
    	$color = $_SESSION['color'];
    	$photo = $_SESSION['photo'] ;
    	$email = $_SESSION['email'];
    	$workplace = $_SESSION['workplace'];
    	$bio = $_SESSION['bio'];
    	$userID= $_SESSION['id'];
	
    }

          
    ?>


<!DOCTYPE html>
    <html lang="en">
        
    <head>
	    <meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
	
    	<title>Tiny Socidia | Search </title>
	
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
	  
	    <a class="navbar-brand" href="home.php">
			<img width="149" height="39" src="dist/brand-white1.png" alt="brand">
		    </a>
		
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active"><a class="nav-link" href='/Home/home.php?id=<?php echo $id ?>'>Home <span class="sr-only">(current)</span></a></li>
				<li class="nav-item"><a class="nav-link" href="profile.php?id=<?php echo $id ?>">Profile</a></li>
			
			</ul>
			<form class="form-inline float-right hidden-sm-down" action='search.php?id=<?php echo $id ?>' method='POST'>
      			<input  name='search' style="margin-right:10px;"class="form-control" type="text" data-action="grow" placeholder="Search email or name">
    		</form>
			<ul class="nav navbar-nav float-right " id="js-popoverContent">
				<li class="nav-item"><a class="nav-link" href="/helperPages/logout.php">Logout<i class="fa fa-sign-out" aria-hidden="false"> </i></a> </li>
			</ul>
			 
    		
		</div>
	</nav>
	
	
	
	
	
	
	<div class="container">
    	<div class="jumbotron">
       <br>
       <br>
       <br><?php
       if(isset($_GET['success']))
		          		echo "<div class='alert alert-success' role='alert'>".$_GET['success']."</div>";
             else if(isset($_GET['error']))
			          	echo "<div class='alert alert-danger' role='alert'>".$_GET['error']."</div>";
			          	?>
        </div>
    
	<div id="friends" class="mt-2"  >
			<div class="row">
				
				<?php
			
				$con = mysqli_connect('127.0.0.1','yosifmk123','','tiny');
									
				if(mysqli_connect_errno($con))
					die("Fail to connect to database :".mysqli_connect_error());
				
	
    
            //      Sender || Receiver
            //       0     ||    0      No releation, display "Send request"
            //       1     ||    1      active relation, display "remove friend"
            //       2     ||    2      for sender display : waiting for accept , For recevier : want to accept? 
            
			        $friends_arr= [];
			        $noRelation_arr = [];
			        $sentReq_arr = [] ;
			        $pendingReq_arr = [];
			        
			    $query = "SELECT * FROM friend WHERE email1 ='$email' OR email2 ='$email'";
			    $result = mysqli_query($con ,$query );
		        
			    while ($row=mysqli_fetch_array($result)){
			       	if($row['status'] == 1){
			       	    $friends_arr[] = $row['email1'];
			       	    $friends_arr[] = $row['email2'];
			       	}
			       else	if($row['status'] == 0){
			       	    $noRelation_arr[]  = $row['email1'];
			       	    $noRelation_arr[]  = $row['email2'];
			       	}
			       else	if($row['email1'] == $email && $row['status'] == 2){
			       	 //   $sentReq_arr[]  = $row['email1'];
			       	    $sentReq_arr[]  = $row['email2'];
			       	}
			       	else if($row['email2'] == $email && $row['status'] == 2){
			       	    $pendingReq_arr[]  = $row['email1'];
			       	 //   $pendingReq_arr[]  = $row['email2'];
			       	}
			       	
			       	}
			       
				 $search = $_POST['search'];
				 
				 if($search == "*")
				     $query = "SELECT * FROM member";
                else
	            $query = "SELECT * FROM member WHERE email ='$search' OR name LIKE '%$search%' ";
				$result = mysqli_query($con ,$query );
				

			
				
				while ($row=mysqli_fetch_array($result)){
				    
				    if($row['email'] == $email) // i dont want to display my self.
				        continue;
				    $color = $row['color'];
				    $profilephoto = $row['profilephoto'];
				    $name = $row['name'];
				    
				    $bio = $row['bio'];
				    $id = $row['ID'];
				    $profile = 'profile.php?id='.$userID.'&target='.$id;
				    
				    
				    $friend = '
				        
				         <div class="col-sm-6">
				    	<div class="card card-profile">
						<div class="card-header" style="background: '.$color.'; "></div>
						
						<div class="card-block text-xs-center">
							<img class="card-profile-img" height =110 width=110 src='.$profilephoto.'>
							
							<a href='.$profile.'><h5 class="card-title">'.$name.'</h5></a>
							
							<p class="mb-4">'.$bio.'</p>
		            	    <form name="friendsform" id="friendsform" action="/helperPages/friendActions.php?target='.$id.'" method="POST"  enctype="multipart/form-data">';

							
							if(in_array($row['email'],$friends_arr)){ // active relation
						    	$friend = $friend . '<button value="remove" name="remove" id="remove" class="btn btn-outline-danger btn-sm"><span class="icon icon-remove-user"></span> Remove From Friends</button>';
							}
							else if(in_array($row['email'],$pendingReq_arr)){ // that means i have a request from this user 
							    $friend = $friend . '<button value="accept" name="accept" class="btn btn-outline-success btn-sm"><span class="icon icon-check"></span> Accept</button>
					        	                     <button value="reject" name="reject" class="btn btn-outline-warning btn-sm"><span class="icon icon-circle-with-cross"></span> Reject</button>' ;
							}
							else if(in_array($row['email'],$sentReq_arr)) // that means i sent a request for this user
							$friend = $friend . '<button class="btn btn-outline-secondary btn-sm"><span class="icon icon-clock"></span> Waiting for Response</button>';
							else{ // means there is nothing between them at all
					        $friend = $friend . '  
					                                <button value="send" name="send" class="btn btn-outline-primary btn-sm"><span class="icon icon-add-user"></span> Send Friend Request</button>';
					        
							}
							$friend = $friend . '</form>	</div> </div> </div>';
					
				
				echo $friend;
				
				}
				 
				?>
				<!--		<div class="card-header" style="background: linear-gradient(#E88801, #FFC200);"></div>-->
				
				<!--		<div class="card-header" style="background: linear-gradient(#6B0618, #C22C48); "></div>-->
			
				<!--		<div class="card-header" style="background: linear-gradient(#588F27, #A9CF54);"></div>-->
	
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
	