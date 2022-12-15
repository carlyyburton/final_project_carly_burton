<?php
	require("connect.php");

	require("authenticate.php");
	
	session_start();

	if ($_POST && !empty($_POST['genre'])) {
        $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $query = "INSERT INTO games_genre (genre) VALUES (:genre)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':genre', $genre);
         
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
	<title>New Genre</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php
		include("nav.php")
	?>
	<div id="newGenre">
	<h3>Add a New Game Genre!</h3>
	<br>
	<form method="post"
		  action="newGenre.php">
		<label for="genre">Genre:</label>
		<input type="text" id="genre" name="genre">
		<br>
		<br>
		<button type="submit">Submit</button>
	</form>
	</div>
</body>
</html>