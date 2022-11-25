<?php 
	require("connect.php");

	$search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	//$title = filter_input(INPUT_POST, 'game_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	$query = "SELECT * FROM games WHERE game_title LIKE '%$search%'";

	$statement = $db->prepare($query);

	//$statement->bindValue(':search', $search);
	//$statement->bindValue(':game_title', $title);

	$statement->execute();

	$row = $statement->fetch();

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
	<?php if(count($row) > 0): ?>
		<p><a href="gameInfo.php?game_id=<?= $row['game_id'] ?>"><?= $row['game_title'] ?></a></p>
	<?php else: ?>
		<p>No Results</p>
	<?php endif ?>
	</div>
</body>
</html>