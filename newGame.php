<?php
	require('connect.php');

	session_start();

	if ($_POST && !empty($_POST['game_title']) && !empty($_POST['plot'])) {
        $title = filter_input(INPUT_POST, 'game_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $date = filter_input(INPUT_POST, 'release_date', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $genre = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $plot = filter_input(INPUT_POST, 'plot', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $query = "INSERT INTO games (game_title, release_date, genre, plot, image) VALUES (:game_title, :release_date, :genre, :plot, :image)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':game_title', $title);
        $statement->bindValue(':release_date', $date);
        $statement->bindValue(':genre', $genre);
        $statement->bindValue(':plot', $plot);
        $statement->bindValue(':image', $image);
         
        if ($statement->execute()) {
            echo "Success";
        }

    }

    function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
    	$current_folder = dirname(__FILE__);

    	$path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];

    	return join(DIRECTORY_SEPARATOR, $path_segments);
    }

    function file_is_an_image($temporary_path, $new_path) {
    	$allowed_mime_types = ['image/gif', 'image/jpeg', 'image/png'];
    	$allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];

    	$actual_file_extension = pathinfo($new_path, PATHINFO_EXTENSION);
    	$actual_mime_type = getimagesize($temporary_path)['mime'];

    	$file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
    	$mime_type_is_valid = in_array($actual_mime_type, $allowed_mime_types);

    	return $file_extension_is_valid && $mime_type_is_valid;
    }

    $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
    $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

    if($image_upload_detected) {
    	$image_filename = $_FILES['image']['name'];
    	$temporary_image_path = $_FILES['image']['tmp_name'];
    	$new_image_path = file_upload_path($image_filename);
    	if(file_is_an_image($temporary_image_path, $new_image_path)) {
    		move_uploaded_file($temporary_image_path, $new_image_path);
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
	<div id="newGameForm">
		<h3>Add a New Game</h3>
		<form method="post"
			  action="newGame.php"
			  enctype='multipart/form-data'>
			<label for="game_title">Title:</label>
			<br>
			<input type="text" name="game_title" id="game_title">
			<br>
			<label for="release_date">Release Date:</label>
			<br>
			<input type="date" name="release_date" id="release_date">
			<br>
			<label for="genre">Genre:</label>
			<br>
			<select name="genre" id="genre">
				<option value="Action RPG">Action RPG</option>
				<option value="Fighting">Fighting</option>
				<option value="Puzzle">Puzzle</option>
				<option value="Racing">Racing</option>
				<option value="Sports">Sports</option>
			</select>
			<br>
			<label for="plot">Plot:</label>
			<br>
			<textarea id="plot" name="plot" rows="10" cols="60"></textarea>
			<br>
			<br>
			<div class="image">
				<p>Image Optional</p>
				<label for='image'>Image:</label>
		        <input type='file' name='image' id='image'>
		        <br>
		        <label for="image">Please write the filename here:</label>
		        <input type="text" name="image" placeholder="filename">
	         </div>
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
	</div>
</body>
</html>