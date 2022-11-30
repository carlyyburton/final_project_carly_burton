<?php 
	require('connect.php');

	//$id = filter_input(INPUT_POST, 'game_id', FILTER_SANITIZE_NUMBER_INT);

	$genre = filter_input(INPUT_GET, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$title = filter_input(INPUT_POST, 'game_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$query = "SELECT game_title FROM games WHERE genre LIKE '%$genre%'";

	$statement = $db->prepare($query);

	//$statement->bindValue(':genre', $genre);
	//$statement->bindValue(':game_id', $id, PDO::PARAM_INT);
	//$statement->bindValue(':game_title', $title);

	$statement->execute();

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
		<ul>
		<?php while($row = $statement->fetch()): ?>
			<li><?= $row['game_title'] ?></li>
		<?php endwhile ?>
		</ul>
	</div>
</body>
</html>