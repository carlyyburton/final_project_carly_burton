<?php 
	require('connect.php');

	session_start();

	$id = filter_input(INPUT_POST, 'game_id', FILTER_SANITIZE_NUMBER_INT);

	$genre = filter_input(INPUT_GET, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$title = filter_input(INPUT_POST, 'game_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$query = "SELECT * FROM games WHERE genre = :genre";

	$statement = $db->prepare($query);

	$statement->bindValue(':genre', $genre);

	$statement->execute();

	$count = $statement->rowCount();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Games In This Genre</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php 
		include('nav.php')
	?>
	<div id="fullGenres">
		<h3><?= $genre ?> Games</h3>
		<ul>
		<?php while($row = $statement->fetch()): ?>
			<li><a href="gameInfo.php?game_id=<?= $row['game_id'] ?>"><?= $row['game_title'] ?></a></li>
		<?php endwhile ?>
		</ul>
		<?php if($count === 0): ?>
			<p>No games found in this genre.</p>
		<?php endif ?>
	</div>
</body>
</html>