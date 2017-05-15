<?php
	session_start();
	
	if(!isset($_SESSION['id'])){
		header("Location: /Home/home.php?error=Error posting");
		die();

		
	}else if (!isset($_POST['text']) && !isset($_POST['selectedFile']) ){
    
    	header("Location: /Home/home.php?error=your post is empty");
		die();

	}else{
	
		$name = $_SESSION['name'];
		$photo = $_SESSION['photo'] ;
		$email = $_SESSION['email'];
		$con = mysqli_connect('127.0.0.1','yosifmk123','','tiny');
		
    	if(mysqli_connect_errno($con))
			die("Fail to connect to database :".mysqli_connect_error());
	


	}

    if(isset($_POST['text'])) // if there is text in the post
         $text = $_POST['text'];
    else
         $text = '';

	if(isset($_FILES['selectedFile']['tmp_name']) && $_FILES['selectedFile']['tmp_name'] !='' ){
		
	$filename = $_FILES['selectedFile']['name'];
	$tmp = $_FILES['selectedFile']['tmp_name'];
	$error = $_FILES['selectedFile']['error'];
	
	if($error > 0 )
		die("Error uploading file! code $error" );
	else{
		
	$filendest = '../Home/public/img/'.uniqid().$filename;
		move_uploaded_file($tmp,  $filendest  );
			
	}
		}else {
		    $filendest = '';
		}
		$date = date("Y-m-d H:i:s");     
		$query = "INSERT INTO `post` VALUES (null,'$text','$filendest','$email','$date')";
        $insert = mysqli_query($con ,$query ); 

    header("Location: /Home/home.php?upload=done");




?>

