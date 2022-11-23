<?php 
	require('connect.php');

	$genre = filter_input(INPUT_GET, 'genre_id', FILTER_SANITIZE_NUMBER_INT);

	$game = filter_input(INPUT_GET, 'game_id', FILTER_SANITIZE_NUMBER_INT);

	$title = filter_input(INPUT_POST, 'game_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	//$query = "SELECT * FROM games_genre WHERE genre_id = :genre_id";

	$query = "SELECT * FROM games_genre JOIN games ON games.game_id = games_genre.game_id WHERE game_id = :game_id";

	$statement = $db->prepare($query);

	$statement->bindValue(':genre_id', $genre, PDO::PARAM_INT);
	$statement->bindValue(':game_id', $game, PDO::PARAM_INT);
	$statement->bindValue(':game_title', $title);

	$statement->execute();

	//THIS PAGE IS NOT WORKING RIGHT NOW 

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
		<h3>Games</h3>
		<?php while($row = $statement->fetch()): ?>
			<li><?= $row['game_title'] ?></li>
		<?php endwhile ?>
	</div>
</body>
</html>