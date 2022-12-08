<?php 
	require('connect.php');

	session_start();

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
				<li><span>Title:</span> <?= $row['game_title'] ?></li>
				<li><span>Release Date:</span> <?= $row['release_date'] ?></li>
				<li><span>Genre:</span> <?= $row['genre']?></li>
				<li><span>Plot:</span> <?= $row['plot'] ?></li>
			<?php if(!empty($row['image'])): ?>
				<li><img src="uploads/<?= $row['image'] ?>.jpg" alt="video game"></li>
			<?php endif ?>
			<?php endwhile ?>
		</ul>
		<br>
		<h3><a href="reviews.php">Click here to read reviews!</a></h3>	
	</div>
</body>
</html>
