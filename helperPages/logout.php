 <?php
 
       session_start();
       
       if(!isset($_SESSION['id'])){
    		header("Location: /Home/LandingPage.php?error=Please sign in again!");
         }
 
       session_unset();
       session_destroy();

       header("Location: /Home/LandingPage.php?success=See You Next Time!");
    ?>