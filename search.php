<?php 
	require("connect.php");

	$search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$query = "SELECT * FROM games WHERE game_title LIKE '%$search%'";

	$statement = $db->prepare($query);

	$statement->execute();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Search Results</title>
</head>
<body>
	<?php
		include("nav.php")
	?>
	<div id="results">
		<h4>Results</h4>
		<br>
	<?php while($row = $statement->fetch()): ?>
		<p><a href="gameInfo.php?game_id=<?= $row['game_id'] ?>"><?= $row['game_title'] ?></a></p>
	<?php endwhile ?>
	</div>
</body>
</html>