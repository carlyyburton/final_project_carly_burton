<?php 
	require('connect.php');

	session_start();

	if ($_POST && !empty($_POST['game_title']) && !empty($_POST['release_date']) && !empty($_POST['genre']) && !empty($_POST['plot'])) {

		$id = filter_input(INPUT_POST, 'game_id', FILTER_SANITIZE_NUMBER_INT);
		$title = filter_input(INPUT_POST, 'game_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$date = filter_input(INPUT_POST, 'release_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$plot = filter_input(INPUT_POST, 'plot', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$query = "UPDATE games SET game_title = :game_title, release_date = :release_date, genre = :genre, plot = :plot, image = :image WHERE game_id = :game_id LIMIT 1";

		$statement = $db->prepare($query);

		$statement->bindValue(':game_id', $id, PDO::PARAM_INT);
		$statement->bindValue(':game_title', $title);
		$statement->bindValue(':release_date', $date);
		$statement->bindValue(':genre', $genre);
		$statement->bindValue(':plot', $plot);
		$statement->bindValue(':image', $image);

		$statement->execute();

		header("Location: index.php");
		exit;
	}
	elseif (!empty($_GET['game_id'])) {
		$id = filter_input(INPUT_GET, 'game_id', FILTER_SANITIZE_NUMBER_INT);

		$query = "SELECT * FROM games WHERE game_id = :game_id";

		$statement = $db->prepare($query);
		$statement->bindValue(':game_id', $id, PDO::PARAM_INT);

		$statement->execute();
		$games = $statement->fetch();
	}
	else{
		$id = false;
	}

	$error = "*Make sure all fields are filled out before submitting*";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Game</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php 
		include("nav.php")
	?>
	<?php if($id): ?>
		<form method="post"
			  id="edit"
			  action="edit.php">
			<input type="hidden" id="game_id" name="game_id" value="<?= $games['game_id'] ?>">

			<label for="game_title">Game Title:</label>
			<input type="text" id="game_title" name="game_title" value="<?= $games['game_title'] ?>">
			<br>
			<br>
			<label for="release_date">Release Date:</label>
			<input type="date" id="release_date" name="release_date" value="<?= $games['release_date'] ?>">
			<br>
			<br>
			<label for="genre">Genre:</label>
			<select name="genre" id="genre">
			<option value="Action RPG">Action RPG</option>
			<option value="Fighting">Fighting</option>
			<option value="Puzzle">Puzzle</option>
			<option value="Racing">Racing</option>
			<option value="Sports">Sports</option>
			</select>
			<br>
			<br>
			<label for="plot">Plot:</label>
			<textarea id="plot" name="plot" rows="10" cols="50"><?= $games['plot']?></textarea>
			<br>
			<br>
			<?php if(!empty($games['image'])): ?>
				<label for="image">Current Image Filename:</label>
				<input type="text" name="image" id="image" value="<?= $games['image'] ?>">
				<button type="button" id="imageBtn" onClick="document.querySelector('#image').value = ''">Remove Image</button>
				<br>	
			<?php endif ?>
			<br>
			<button type="submit">Update</button>
			<button type="submit" formaction="admin.php">Cancel</button>	
		</form>
	<?php elseif(empty($games['game_title']) && empty($games['release_date']) && empty($games['genre']) && empty($games['plot'])): ?>
		<h5><?= $error ?></h5>
	<?php endif ?>
</body>
</html>