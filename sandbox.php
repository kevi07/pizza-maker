<?php 

	if(isset($_POST['submit'])) {

        setcookie('gender',$_POST['gender'],time() + 86400);

		session_start();

		$_SESSION['name'] = $_POST['name'];

		header('Location:index.php');
	}

	
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>php tuts</title>
 </head>
 <body>
 
 	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
 		<input type="text" name="name">
        <select name="gender">
            <option value="male">Male<option>
            <option value="female">Female</option>
        </select>
 		<input type="submit" name="submit" value="submit">
 	</form>

 </body>
 </html>