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
	<div id="logout">
		<?//php if(): ?>

		<?//php endif ?>
	<h4>Hello User!</h4>
	<a href="logout.php">Log out?</a>
	</div>
	<div id="navbar">
		<nav>
			<a href="index.php">Home Page</a> |
			<a href="genre.php">Game Genres</a> |
			<a href="reviews.php">Reviews</a> |
			<a href="login.php">Log In</a> |
			<a href="admin.php">Admin</a>
		</nav>
	</div>
	<form method="post"
		  id="searchBar"
		  action="search.php">
		<input type="text" name="search" id="search" placeholder="Search By Game Title">
		<button type="submit" onclick="if(document.querySelector('#search').value.length < 1) event.preventDefault()">Search</button>
	</form>
</body>
</html>