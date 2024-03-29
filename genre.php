<?php 
	require('connect.php');

	session_start();

	$query = "SELECT * FROM games_genre ORDER BY genre ASC";

	$statement = $db->prepare($query);

	$statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Game Genres</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php 
		include("nav.php")
	?>
	<div id="game_genre">
		<h3>Genres</h3>
		<ul>
			<?php while($row = $statement->fetch()): ?>
				<li><a href="genresFullPage.php?genre=<?= $row['genre'] ?>"><?= $row['genre'] ?></a></li>
			<?php endwhile ?>
		</ul>
	</div>
</body>
</html>