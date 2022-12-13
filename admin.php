<?php 
	require("authenticate.php");

	require('connect.php');

	session_start();

	// Displays the games
	$query = "SELECT * FROM games ORDER BY game_title ASC";
	$statement = $db->prepare($query);
	$statement->execute();

	// Displays the users
	$query2 = "SELECT * FROM users ORDER BY email ASC";
	$statement2 = $db->prepare($query2);
	$statement2->execute();

	// Displays the game genres
	$query3 = "SELECT * FROM games_genre ORDER BY genre ASC";
	$statement3 = $db->prepare($query3);
	$statement3->execute();

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
		<br>
		<h3>Games</h3>
			<ul>
			<?php while($row = $statement->fetch()): ?>
				<li><?= $row['game_title'] ?> - <a href="edit.php?game_id=<?= $row['game_id'] ?>">Edit</a> or <a onclick="if(!confirm('Are you sure you want to delete this game?')) event.preventDefault()" href="delete.php?game_id=<?= $row['game_id'] ?>"><span>Delete<span></a></li>
			<?php endwhile ?>
			</ul>
			<br>
		<p><a href="newGame.php">Add a New Game to the List!</a></p>
		<p>_______________</p>
		<br>
		<h3>Game Genres</h3>
			<ul>
			<?php while($row3 = $statement3->fetch()): ?>
				<li><?= $row3['genre'] ?></li>
			<?php endwhile ?>
			</ul>
			<br>
			<p><a href="newGenre.php">Add a New Game Genre!</a></p>
		<p>_______________</p>
		<br>
		<h3>Users</h3>
		<ul>
		<?php while($row2 = $statement2->fetch()): ?>
			<li><?= $row2['first_name'] ?> - <?= $row2['email'] ?> - <a href="editUsers.php?user_id=<?= $row2['user_id'] ?>">Edit</a> or <a onclick="if(!confirm('Are you sure you want to delete user?')) event.preventDefault()" href="delete.php?user_id=<?= $row2['user_id'] ?>"><span>Delete<span></a></li>
		<?php endwhile ?>
		</ul>
		<br>
		<p><a href="createAccount.php">Add a New User!</a></p>
	</div>
	<footer>
		<br>
		<br>
	</footer>
</body>
</html>