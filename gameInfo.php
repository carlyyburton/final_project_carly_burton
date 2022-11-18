<?php 
	require('connect.php');

	$id = filter_input(INPUT_GET, 'game_id', FILTER_SANITIZE_NUMBER_INT);

	$query = "SELECT * FROM games WHERE game_id = :id";

	$statement = $db->prepare($query);

	$statement->bindValue(':id', $id, PDO::PARAM_INT);

	$statement->execute();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Video Game Database</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php
		include("nav.php")
	?>
	<div id="gameInfo">
		<ul>
			<?php while($row = $statement->fetch()): ?>
				<li>Game ID: <?= $row['game_id'] ?></li>
				<li>Title: <?= $row['game_title'] ?></li>
				<li>Release Date: <?= $row['release_date'] ?></li>
				<li>Genre: <?= $row['genre']?></li>
				<li>Plot: <?= $row['plot'] ?></li>
			<?php endwhile ?>
		</ul>
		<h3><a href="reviews.php">Click here to read reviews!</a></h3>	
	</div>
</body>
</html>
