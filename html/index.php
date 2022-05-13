<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<body>
	<img class="wave" src="img/wave.png">
	<img class="wave" src="img/Place-Clouds.svg">
	<div class="container">
		<div class="img">
			<img src="img/pixlr-bg-result.png">
		</div>
		
		<div class="card login-content">
      </ul>
			<form action="index.html">
				<img src="img/Place-Mountains.svg">
				<h2 class="title">Thanakrit.N (Krit)</h2>
				<?php
				$servername = "db";
				$username = "devops";
				$password = "devops101";
			 
				$dbhandle = mysqli_connect($servername, $username, $password);
				$selected = mysqli_select_db($dbhandle, "titanic");
				
				echo "Connected database server<br>";
				echo "Selected database";
			 	?>
           		
            	<!-- <a href="#">Forgot Password?</a>
            	<input type="submit" class="btn" value="Submit" id="submit"> -->
			</form>
		</div>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
	<!-- <script>
		$('submit').on('click',function(){
			submit();
		})
	</script> -->
</body>
</html>
