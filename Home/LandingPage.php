

<!DOCTYPE html>
<html>
  <head>
    
    <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="/Home/public/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/Home/dist/LandingPage.css">
    <link href="dist/toolkit.css" rel="stylesheet">
  	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>

    
	  <title>Tiny Socidia | Welcome</title>
	
  	


    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="/Home/dist/LandingPage.js"></script>
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    
    <title>Tiny Socidia</title>
    
  </head>




  <body>
 

  <div class="container">
    <div class="row">
      <div class=" col-lg-12">

        <div id="content">


        <h1>Tiny Socidia </h1>
        <h3>The Best Place To Share Moments</h3>
        <hr>

       <?php
             if(isset($_GET['success']))
		          		echo "<div class='alert alert-success' role='alert'>".$_GET['success']."</div>";
             else if(isset($_GET['error']))
			          	echo "<div class='alert alert-danger' role='alert'>".$_GET['error']."</div>";

		?>

          <div class="login-page">
            <div class="form1">
              <form class="register-form1" action="/helperPages/register.php" method="POST"  enctype="multipart/form-data">
                <input required type="text" name='name'placeholder="name"/>
                <input required type="password" name='pass1' placeholder="password"/>
                <input required type="password" name='pass2'placeholder="retype password"/>
                <input required type="email" name='email' placeholder="email address"/>
                <input required type="date" name='date' placeholder="date of birth"/>
                <select style='margin-bottom:5%;' name='gender'>
                   <option > Male </option>
                   <option > Female </option>
                </select>
                <input required type="text" name='workplace'placeholder="workplace"/>
                 <p class="message1" style="color:white;" for="profilephoto">Upload a profile photo:</p>
                 <br>
                <input required type="file" name="profilephoto" accept="image/*" id='profilephoto' placeholder="profile photo"/>
                <p class="message1" style="color:white;" for="color">Choose your favorite color</p>
                <br>
                <input  type="color" name='color'placeholder="favorite color, you can use rgb"/>
                <input  type="text" name='bio'placeholder="a short bio.."/>
                <button>create</button>
                <p class="message1">Already registered? <a onclick="a()" href="#">Sign In</a></p>
              </form>
              
              <form class="login-form1" action="/helperPages/login.php" method="post">
                <input type="email" name="email" placeholder="email"/>
                <input type="password" name="password" placeholder="password"/>
                <button>login</button>
                <p class="message1">Not registered? <a onclick="a()" href="#">Create an account</a></p>
              </form>
            </div>
          </div>
  </div>

    </div>
          </div>
          
          
  </body>
</html>
