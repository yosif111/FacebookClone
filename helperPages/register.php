<?php 
	session_start();

	$con = mysqli_connect('127.0.0.1','yosifmk123','','tiny');
	
	if(mysqli_connect_errno($con)){
			die("Fail to connect to database :".mysqli_connect_error());
		}
	
	$name = $_POST['name'];
	$pass1 = $_POST['pass1'];
	$pass2 = $_POST['pass2'];
	$email = $_POST['email'];
	$date= $_POST['date'];
	$gender = $_POST['gender'];
	$workplace = $_POST['workplace'];
	$color = $_POST['color'];
	$bio = $_POST['bio'];
	
	if(isset($_FILES['profilephoto']['name'])){
		
		$filename = $_FILES['profilephoto']['name'];
		$tmp = $_FILES['profilephoto']['tmp_name'];
		$error = $_FILES['profilephoto']['error'];
	

	if($error > 0 )
		die("Error uploading file! code $error");
	else{
		
		$filendest = '../Home/public/img/'.uniqid().$filename;
		move_uploaded_file($tmp,  $filendest  );
			
	}
		}
		
		
	if($pass1 != $pass2){
		 mysqli_close();
		 header("Location: LandingPage.php?error=Password dosent match");
		 die();
	}
	
	if(strlen($pass1)  < 5){
		mysqli_close();
		 header("Location: LandingPage.php?error=Password has to be at least 6 characters long ");
		 die();
	}
	
	$checkingquery = "SELECT email FROM member WHERE email = '$email'";
	$check = mysqli_query($con,$checkingquery);           // check if email exists


	if( mysqli_num_rows($check) > 0 ){
		 mysqli_close();
    	 header("Location: /Home/LandingPage.php?error=This email is already registered");
    	 die();
		}

	$hashedpass = hash('sha512', $pass1);
	$query = " INSERT INTO member VALUES ('$email','$hashedpass','$name','$date','$gender','$workplace','$filendest','$color','$bio',null)";
	$result = mysqli_query($con,$query);
	
	if(mysqli_errno() ==0){
		mysqli_close();
		header("Location: /Home/LandingPage.php?success=You have Signed Up!");
	}
	else{
	    mysqli_close();
	    header("Location: /Home/LandingPage.php?error=Error!");
	}

?>

