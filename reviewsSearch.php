<?php
	require("connect.php");

	session_start();

	$search = filter_input(INPUT_POST, 'reviewSearch', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$query = "SELECT * FROM games_comments WHERE game_title LIKE '%$search%'";

	$statement = $db->prepare($query);

	$statement->execute();

	$rows = $statement->rowCount();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Results</title>
</head>
<body>
	<?php 
		include('nav.php');
	?>
	<div id="results">
		<h3>Reviews</h3>
		<br>
		<ul>
			<?php while($row = $statement->fetch()): ?>
			<li><span>Game:</span> <?= $row['game_title'] ?></li>
				<li><span>Reviewed By:</span> <?= $row['reviewer'] ?></li>
				<li><span>Review:</span> <?= $row['comment'] ?></li>
				<li><a onclick="if(!confirm('Are you sure you want to delete this review?')) event.preventDefault()" href="delete.php?comment_id=<?= $row['comment_id'] ?>">Delete?</a></li>
				<br>
			<?php endwhile ?>
		</ul>	
		<?php if($rows == 0): ?>
			<p>No Reviews Found.</p>
		<?php endif ?>
	</div>
</body>
</html>