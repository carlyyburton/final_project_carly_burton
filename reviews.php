<?php 
	require('connect.php');

	$id = filter_input(INPUT_GET, 'game_id', FILTER_SANITIZE_NUMBER_INT);

	$query = "SELECT * FROM games_comments WHERE game_id = :id";

	$statement = $db->prepare($query);

	$statement->bindValue(':id'. $id, PDO::PARAM_INT);

	$statement->execute();

	if ($_POST && !empty($_POST['game_title']) && !empty($_POST['reviewer']) && !empty($_POST['comment'])) {
        $title = filter_input(INPUT_POST, 'game_title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $name = filter_input(INPUT_POST, 'reviewer', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $review = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $query = "INSERT INTO games_comments (game_title, reviewer, comment) VALUES (:game_title, :reviewer, :comment)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':game_title', $title);
        $statement->bindValue(':reviewer', $name);
        $statement->bindValue(':comment', $review);
         
        if ($statement->execute()) {
            echo "Success";
        }

    }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Reviews</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php
		include("nav.php") 
	?>
	<div id="reviews">
		<h4>Sort Reviews By Game Title</h4>
		<h4><a href="#review_form">Or Click Here to Write Your Own Review!</a></h4>
		<h3>Reviews</h3>
			<ul>
			<?php while($row = $statement->fetch()): ?>
				<li>Game: <?= $row['game_title'] ?></li>
				<li>Reviewed By: <?= $row['reviewer'] ?></li>
				<li>Review: <?= $row['comment'] ?></li>
				<br>
			<?php endwhile ?>
			</ul>
		<h3>Write Your Review Below!</h3>
		<form method="post"
			  id="review_form">
			<label for="title">Game Title:</label>
			<input type="text" name="title">
			<br>
			<label for="name">Your Name:</label>
			<input type="text" name="name">
			<br>
			<label for="review">Review:</label>
			<textarea id="review" rows="8" cols="40"></textarea>
			<br>
			<button type="submit">Add Review</button>
		</form>
	</div>
</body>
</html>