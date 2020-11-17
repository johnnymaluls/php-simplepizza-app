<?php 
	// include db connection
	include('config/db_connect.php');

	//check GET request ID param
	if(isset($_GET['id'])) {
		$id = mysqli_real_escape_string($conn,$_GET['id']);

		//make sql query
		$sql = "SELECT * from pizza_tb WHERE id = $id";

		//get the query results
		$result = mysqli_query($conn,$sql);

		//fetch the results
		$pizza_arr = mysqli_fetch_assoc($result);

		//mysqli_free_result($result);
		//mysqli_close($conn);
	}


	if(isset($_POST['delete'])){
		$id_to_delete = mysqli_real_escape_string($conn,$_POST['id_to_delete']);

		$sql = "DELETE FROM pizza_tb WHERE id = $id_to_delete";

		if(mysqli_query($conn, $sql)) {
			echo '<script>alert("Delete Successful")</script>';
			header('Location: index.php');
		}

		else {
			echo 'ERROR' . mysqli_error($conn);
		}
	}

 ?>


<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<div class="container center grey-text">
	<?php if($pizza_arr): ?>
		<h4><?php echo htmlspecialchars($pizza_arr['title']); ?></h4>
		<p>Created By: <?php echo htmlspecialchars($pizza_arr['email']); ?></p>
		<p>Created At: <?php echo htmlspecialchars($pizza_arr['created_at']); ?></p>
		<h5>Ingredients</h5>
		<p><?php echo htmlspecialchars($pizza_arr['ingredients']); ?></p>


		<!-- DELETE FORM -->
		<form action = "details.php" method = "post">
			<input type="hidden" name="id_to_delete" value = "<?php echo $pizza_arr['id'];?>">
			<input type="submit" name="delete" value = "Delete" class = "btn brand z-depth-0">
		</form>

	<?php else: ?>
		<h5>NO SUCH PIZZA EXIST!</h5>

	<?php endif; ?>

</div>



<?php include('templates/footer.php'); ?>
</html>