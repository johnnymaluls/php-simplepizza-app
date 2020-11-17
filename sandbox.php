<?php 
	if(isset($_POST['submit'])){

		//set cookie
		setcookie('gender',$_POST['gender'],time() + 86400);


		//session start
		session_start();
		$_SESSION['name'] = $_POST['name'];
		

		header('Location: index.php');


	}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Sand Box</title>
</head>
<body>

<form action= "sandbox.php"method ="POST">
	<input type="text" name="name">
	<select name = "gender">
		<option value = "male">male</option>
		<option value = "female">female</option>
	</select>
	<button type = "submit" name="submit">Submit</button>

</form>

</body>
</html>