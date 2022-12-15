<?php 

?>

<h1>Video Game Database</h1>
<?php if($_SESSION): ?>
	<div id="logout">
		<p>Welcome back, <?= $_SESSION['first_name'] ?>!</p>
		<a href="logout.php">Log Out?</a>
	</div>
<?php endif ?>
<form method="post"
	  id="searchBar"
	  action="search.php">
	<input type="text" name="search" id="search" placeholder="Search By Game Title">
	<button type="submit" onclick="if(document.querySelector('#search').value.length < 1) event.preventDefault()">Search</button>
</form>
<div id="navbar">
	<nav>
		<a href="index.php">Home Page</a> |
		<a href="genre.php">Game Genres</a> |
		<a href="reviews.php">Reviews</a> |
		<a href="login.php">Log In</a> |
		<a href="admin.php">Admin</a>
	</nav>
</div>


