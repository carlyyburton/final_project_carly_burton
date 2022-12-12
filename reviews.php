<?php 
	require('connect.php');

	session_start();

	$query = "SELECT * FROM games_comments ORDER BY game_title ASC";

	$statement = $db->prepare($query);

	$statement->execute();

?>

<!DOCTYPE html>
<html>
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
		<h4>Search For Reviews By Game Title</h4>
		<label for="comment">Game Title:</label>
		<input name="comment" placeholder="Search for reviews">
		<button type="submit">Go!</button>
		<h4>~</h4>
		<h4><a href="addReview.php">Click Here to Write Your Own Review!</a></h4>
		<h3>Reviews</h3>
			<ul>
			<?php while($row = $statement->fetch()): ?>
				<li><span>Game:</span> <?= $row['game_title'] ?></li>
				<li><span>Reviewed By:</span> <?= $row['reviewer'] ?></li>
				<li><span>Review:</span> <?= $row['comment'] ?></li>
				<li><a onclick="if(!confirm('Are you sure you want to delete this review?')) event.preventDefault()" href="delete.php?comment_id=<?= $row['comment_id'] ?>">Delete?</a></li>
				<br>
			<?php endwhile ?>
			</ul>
	</div>
</body>
</html>