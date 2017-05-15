<?php 

	session_start();

	$con = mysqli_connect('127.0.0.1','yosifmk123','','tiny');
	
	if(mysqli_connect_errno($con))
		die("Fail to connect to database :".mysqli_connect_error());
	
	$email = $_POST['email'];
	$hashedpass = hash('sha512', $_POST['password']);

	$query =" SELECT * FROM member WHERE email = '$email' AND password =  '$hashedpass'";

	$result = mysqli_query($con,$query);

	if(mysqli_num_rows($result) >0){
		
		$row=mysqli_fetch_array($result);
		
		// fill the session
		$_SESSION['email'] = $row['email'];
		$_SESSION['name'] = $row['name'];
		$_SESSION['date'] = $row['birth_date'];
		$_SESSION['photo'] = $row['profilephoto'];
		$_SESSION['color'] = $row['color'];
		$_SESSION['workplace'] = $row['workplace'];
		$_SESSION['bio'] = $row['bio'];
		$_SESSION['id'] = $row['ID'];
		// $_SESSION
		$userID = $_SESSION['id'];
		mysqli_close();
		header("Location: /Home/home.php?id=$userID");
		
	}
	else {
		mysqli_close();
		header("Location: /Home/LandingPage.php?error=Wrong Username/Password");
}