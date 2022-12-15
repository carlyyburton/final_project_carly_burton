<?php 
	require("connect.php");

	session_start();

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
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Add Review</title>
		<link rel="stylesheet" type="text/css" href="styles.css">
		<script src="captcha.js"></script>
</head>
<body onload="hideReviewForm()">
		<?php 
			include("nav.php");
		?>
		<div id="reviews" >
		<div class="container">
				<h4>First, verify that you're human.</h4>
		    <div id="captcha" class="captcha"><script>createCaptcha();</script></div>
		    <div class="restart">
		      	<a href="#" onclick="createCaptcha()">New Captcha</a>
		    </div>
		    <div class="input">
		        <input type="text" name="reCaptcha" id="reCaptcha" placeholder="Type The Captcha">
		    </div>
		    <div><input type="button" value="Submit" onclick="validateCaptcha()"></div>
		    <div id="errCaptcha" class="errmsg"></div>
	  </div>
  	<div id="reviewForm">
				<h3>Write Your Review Below!</h3>
				<form method="post"
					  	action="addReview.php">
						<label for="game_title">Game Title:</label>
						<input type="text" id="game_title" name="game_title">
						<br>
						<br>
						<label for="reviewer">Your Name:</label>
						<input type="text" id="reviewer" name="reviewer">
						<br>
						<br>
						<label for="comment">Review:</label>
						<textarea id="comment" name="comment" rows="6" cols="35"></textarea>
						<br>
						<br>
						<button type="submit">Submit</button>
				</form>
		</div>
		</div>
</body>
</html>