<?php 
	require('connect.php');

	$genre = filter_input(INPUT_GET, 'genre_id', FILTER_SANITIZE_NUMBER_INT);

	$title = filter_input(INPUT_POST, 'game_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$query = "SELECT * FROM games_genre WHERE genre_id = :genre";

	$statement = $db->prepare($query);

	$statement->bindValue(':genre_id', $genre, PDO::PARAM_INT);

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