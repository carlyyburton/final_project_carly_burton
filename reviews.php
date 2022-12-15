<?php 
	require('connect.php');

	session_start();

	$query = "SELECT * FROM games_comments ORDER BY comment_id DESC";

	$statement = $db->prepare($query);

	$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reviews</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php
		include("nav.php") 
	?>
	<div id="reviews">
		<h3>All Reviews</h3>
		<br>
		<form id="reviewsSearch"
			  method="post"
			  action="reviewsSearch.php">
			  <label for="reviewSearch">Filter Reviews By Game Title:</label>
			<input type="text" name="reviewSearch" id="reviewSearch" placeholder="Search for reviews">
			<button type="submit" onclick="if(document.querySelector('#reviewSearch').value.length < 1) event.preventDefault()">Go!</button>
		</form>
		<br>
		<h4><a href="addReview.php">Click Here To Write Your Own Review</a></h4>
		<br>
		<ul>
			<?php while($row = $statement->fetch()): ?>
				<li><span><?= $row['game_title'] ?></span></li>
				<li>Reviewed By: <?= $row['reviewer'] ?></li>
				<li>Review: <?= $row['comment'] ?></li>
				<li><a onclick="if(!confirm('Are you sure you want to delete this review?')) event.preventDefault()" href="delete.php?comment_id=<?= $row['comment_id'] ?>">Delete?</a></li>
				<li>&nbsp;</li>
			<?php endwhile ?>
		</ul>
	</div>
	<footer>
	<br>
	<br>
	</footer>
</body>
</html>