<?php 
	require("authenticate.php");

	require('connect.php');

	$query = "SELECT * FROM games ORDER BY game_id DESC";

	$statement = $db->prepare($query);

	$statement->execute();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin Page</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php 
		include("nav.php")
	?>
	<div id="admin">
		<h3>Edit Current Posts or Add a New Game!</h3>
		<h4>Games</h4>
			<ul>
			<?php while($row = $statement->fetch()): ?>
				<li><?= $row['game_title'] ?> - <a href="edit.php?game_id=<?= $row['game_id'] ?>">Edit</a></li>
			<?php endwhile ?>
			</ul>
		<p><a href="newGame.php">Add a New Game to the List!</a></p>
		<h4>Genres</h4>
	</div>
</body>
</html>