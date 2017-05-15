<?php

    session_start();
	 $userID = $_SESSION['id'];
	 
	if(!isset($_SESSION['id'])){
		header("Location: /Home/LandingPage.php?error=Please Sign In again!");
		die();
	}

	if(!isset($_POST['send']) && !isset($_POST['accept']) && !isset($_POST['reject']) & !isset($_POST['remove'])){
	    // means no button was pushed

		header("Location: /Home/search.php?id=$userID");
		 die();
	}
	
	$con = mysqli_connect('127.0.0.1','yosifmk123','','tiny');
	
	if(mysqli_connect_errno($con))
			die("Fail to connect to database :".mysqli_connect_error());
		
	    	//      Sender || Receiver
            //       0     ||    0      No releation, display "Send request"
            //       1     ||    1      active relation, display "remove friend"
            //       2     ||    2      for sender display : waiting for accept , For recevier : want to accept? 
            
            
        $userID = $_SESSION['id'];
    	$targetID = $_GET['target']; // get the id and the target.
	
    	$query = "SELECT email FROM member WHERE ID =$targetID";
    	$result = mysqli_query($con , $query);
	      
	    if(mysqli_num_rows($result) ==0)
		         die('Self-declared error, query returned nothing!');
		    
	   	$row=mysqli_fetch_array($result);
		$target_email =  $row['email'];  
	
		$sender_email = $_SESSION['email']; // misleading names , sender is the current user, target is the friend/other user
		    	
	    if(isset($_POST['send'])){
	    
	        

	         $query = "INSERT INTO friend VALUES ('$sender_email',null,2,null ,'$target_email')";
	         mysqli_query($con , $query);
	         header("Location: /Home/search.php?id=$userID&success=request sent!");
	         die();
	        
       }else if(isset($_POST['accept'])){
	    
	    $query = "UPDATE friend SET status=1 WHERE email1='$target_email' AND email2='$sender_email'";
	    mysqli_query($con , $query);
	    header("Location: /Home/search.php?id=$userID&success=friendship request accepted!");
	    die();
	    
       }else if (isset($_POST['reject'])){
	     $query = "DELETE FROM friend WHERE email1='$target_email'AND email2='$sender_email'";
	      mysqli_query($con , $query);
	      header("Location: /Home/search.php?id=$userID&success=friendship request denied!");
	      die();
	    
		}else if (isset($_POST['remove'])){
			$query = "DELETE FROM friend WHERE
			(email1='$target_email'AND email2='$sender_email' AND status =1 )
			OR	(email2='$target_email'AND email1='$sender_email')";
			
	    	 mysqli_query($con , $query);
			 header("Location: /Home/search.php?id=$userID&success=friend removed!");
	    	 die();
	}
	
