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
	}
		
?>

<!DOCTYPE html>
<html lang="en">
<head>
	
	<meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="/Home/public/editProfile.css">
    <link href="dist/toolkit.css" rel="stylesheet">
  	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>

    
	  <title>Tiny Socidia | Edit Profile</title>
	
  	
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	
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
				<li class="nav-item "><a class="nav-link" href="profile.php?id=<?php echo $userID ?>">Profile</a></li>
				<li class="nav-item active"><a class="nav-link" href="/Home/editProfile.php?id=<?php echo $userID ?>">Edit</a></li>

			</ul>
			<form class="form-inline float-right hidden-sm-down" action='search.php?id=<?php echo $userID ?>' method='POST'>
      			<input  name='search' style="margin-right:10px;"class="form-control" type="text" data-action="grow" placeholder="Search email or name">
    		</form>
			<ul class="nav navbar-nav float-right " id="js-popoverContent">
				<li class="nav-item"><a class="nav-link" href="/Home/logout.php">Logout<i class="fa fa-sign-out" aria-hidden="false"> </i></a> </li>
			</ul>
		</div>
	</nav>
	
	<div class="container">
        <div class="row">
            <div class=" col-lg-12">
                <div class="jumbotron">
                	<div class="login-page">
                	    <div id="form_style">
                              <form class="register-form1" action="/helperPages/update.php?id=<?=$userID?>" method="POST"  enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name" >Name</label>
                                    <input required type="text" class="form-control" id="name" name='name'placeholder="name" value="<?php echo $name ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name='pass1' placeholder="password" />
                                </div>
                                <div class="form-group">
                                    <label for="password2">Retype password</label>
                                    <input type="password" class="form-control" id="password2"name='pass2'placeholder="retype password" />
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input required type="email" class="form-control" id="email" name='email' placeholder="email address" value="<?php echo $email ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="date">Date of birth</label>
                                    <input required type="date" class="form-control" id="date" name='date' placeholder="date of birth" value="<?php echo $date ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="workplace">Workplace</label>
                                    <input required type="text" class="form-control" id="workplace" name='workplace'placeholder="workplace" value="<?php echo $workplace ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select style='margin-bottom:5%;' id="gender" class="form-control" name='gender'>
                                       <option > Male </option>
                                       <option > Female </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="color">Color</label>
                                    <input  type="color" class="form-control" id="color" name='color'placeholder="favorite color" value="<?php echo $color ?>"/>
                                </div>
                                <div class="form-group">
                                    <label for="profilephoto">Profile Photo</label>
                                    <input type="file" accept="image/*" class="form-control-file" id="profilephoto" name="profilephoto" id='profilephoto' placeholder="profile photo" />
                                </div>
                                <div class="form-group">
                                    <label for="bio">Short Bio</label>
                                    <input  type="text" class="form-control" id="bio" name='bio'placeholder="a short bio.." value="<?php echo $bio ?>"/>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="cancel" class="btn btn-danger">Cancel</button>
                                
                              </form>
                        </div>
                	</div>
                </div>
            </div>
        </div>
    </div>
	
	
</body>
</html>