<?php

include('config/db_connect.php');

//CONSTRUCT QUERY
$sql = "SELECT title,ingredients,id FROM pizza_tb";

//MAKE QUERY
$result = mysqli_query($conn, $sql);

// FETCH THE RESULT THEN STORE IN A ASSOCIATIVE ARRAY
$pizza_arr = mysqli_fetch_all($result, MYSQLI_ASSOC);

//FREE THE RESULTS FROM MEMORY  
mysqli_free_result($result);

//CLOSE CONNECTION
mysqli_close($conn);


?>
<!DOCTYPE html>
<html>
	<?php include('templates/header.php'); ?>
		

	<h4 class="center grey-text">Pizzas!</h4>

	<div class="container">
		<div class="row">
			<!-- FOR EACH EVERY PIZZA TO DISPLAY INTO THE CARD HTML -->
			<?php foreach($pizza_arr as $pizza){ ?>

				<div class="col s6 md3">
					<div class="card z-depth-0">
						<img src="img/pizza.svg" class = "pizza">
						<div class="card-content center">
							<h6><b><?php echo(trim($pizza['title'])); ?></b></h6>
							<ul>

							<?php foreach (explode(',',$pizza['ingredients']) as $ing) { ?>
									<li> <?php echo($ing); ?> </li>

							<?php } ?>
							</ul>
						</div>
						<div class="card-action right-align">

							<!-- PASS THE ID TO DETAILS.PHP -->
							<a class="brand-text" href="details.php?id=
							<?php echo $pizza['id'] ?>">more info</a>
						</div>
					</div>
				</div>

			
			<?php } ?>

		</div>
	</div>

	<?php include('templates/footer.php'); ?>

</html>