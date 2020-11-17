<?php 
	
	include('config/db_connect.php');

	//FORM VALIDATION
	//ASSOCIATIVE ARRAY FOR STORING ERROR MESSAGE
	$email = $title = $ingredients = '';
	$errors = array('email' => '', 'title' => '', 'ingredients' => '');

	if(isset($_POST['submit'])){
		
		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address';
			}
		}

		// check title
		if(empty($_POST['title'])){
			$errors['title'] = 'A title is required';
		} else{
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] = 'Title must be letters and spaces only';
			}
		}

		// check ingredients
		if(empty($_POST['ingredients'])){
			$errors['ingredients'] = 'At least one ingredient is required';
		} else{
			$ingredients = $_POST['ingredients'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
				$errors['ingredients'] = 'Ingredients must be a comma separated list';
			}
		}

		//CHECKS IF THE ARRAY FROM TOP HAS ERRORS
		if(array_filter($errors)) {
		} 
		else{
			//MYSQLI REAL ESCAPE STRING IS FOR PREVENTING SQL INJECTIONS
			$email = mysqli_real_escape_string($conn,$_POST['email']);
			$ingredients = mysqli_real_escape_string($conn,$_POST['ingredients']);
			$title = mysqli_real_escape_string($conn,$_POST['title']);

			//CREATE A SQL QUERY
			$sql = "INSERT INTO pizza_tb(title,email,ingredients) VALUES('$title','$email','$ingredients')";

			//SAVE TO DB AND CHECK
			if(mysqli_query($conn,$sql)) {
				header('Location: index.php');
			}
			else {
				echo 'query error: ' . mysqli_error($conn);
			}
		}

		} // end POST check


		

?>

<!DOCTYPE html>
<html>
	
	<?php include('templates/header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add a Pizza</h4>
		<form class="white" action="add.php" method="POST">
			<label>Your Email</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">

			<div class="red-text">
				<?php echo $errors['email']; ?>
			</div>

			<label>Pizza Title</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">

			<div class="red-text">
				<?php echo $errors['title']; ?>		
			</div>

			<label>Ingredients (comma separated)</label>
			<input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">

			<div class="red-text">
				<?php echo $errors['ingredients']; ?>
			</div>

			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>

		</form>
	</section>

	<?php include('templates/footer.php'); ?>

</html>