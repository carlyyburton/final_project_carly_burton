<?php
	require('connect.php');

	if ($_POST && !empty($_POST['game_title']) && !empty($_POST['plot'])) {
        $title = filter_input(INPUT_POST, 'game_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date = filter_input(INPUT_POST, 'release_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $plot = filter_input(INPUT_POST, 'plot', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $query = "INSERT INTO games (game_title, release_date, genre, plot) VALUES (:game_title, :release_date, :genre, :plot)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':game_title', $title);
        $statement->bindValue(':release_date', $date);
        $statement->bindValue(':genre', $genre);
        $statement->bindValue(':plot', $plot);
         
        if ($statement->execute()) {
            echo "Success";
        }

    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>New Post</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php
		include("nav.php")
	?>
	<h3>Add a New Game</h3>
	<form method="post"
		  action="newGame.php">
		<label for="game_title">Title</label>
		<br>
		<input type="text" name="game_title" id="game_title">
		<br>
		<label for="release_date">Release Date</label>
		<br>
		<input type="date" name="release_date">
		<br>
		<label for="genre">Genre:</label>
		<br>
		<select name="genre" id="genre">
			<option value="Action RPG">Action RPG</option>
			<option value="Fighting">Fighting</option>
			<option value="Racing">Racing</option>
			<option value="Sports">Sports</option>
		</select>
		<br>
		<label for="plot">Plot</label>
		<br>
		<textarea id="plot" name="plot" rows="10" cols="60"></textarea>
		<br>
		<br>
		<button type="submit">Create</button>
	</form>
	<?php if (!isset($title)): ?>
		<h5>Must have a game title.</h5>	
	<?php endif ?>
	<?php if (!isset($date)): ?>
		<h5>Must have a release date.</h5>	
	<?php endif ?>
	<?php if (!isset($plot)): ?>
		<h5>Must have a plot.</h5>	
	<?php endif ?>
</body>
</html>