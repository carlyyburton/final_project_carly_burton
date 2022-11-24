<?php
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
	<title>Video Game Database</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php
		include("nav.php")
	?>
	<div id="listOfGames">
		<h3>List of Games</h3>
		<ul>
			<?php while($row = $statement->fetch()): ?>
				<li><a href="gameInfo.php?game_id=<?= $row['game_id'] ?>"><?= $row['game_title'] ?></a></li>
			<?php endwhile ?>
		</ul>
	</div>
</body>
</html>
