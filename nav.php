<?php 


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Nav Bar</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<h1>Video Game Database</h1>
	<div id="navbar">
		<nav>
			<a href="index.php">Home Page</a> |
			<a href="genre.php">Game Genres</a> |
			<a href="reviews.php">Reviews</a> |
			<a href="admin.php">Admin</a>
		</nav>
	</div>
	<form id="searchBar">
		<input type="text" name="search">
		<button type="submit">Search</button>
	</form>
</body>
</html>