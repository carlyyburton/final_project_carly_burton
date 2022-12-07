<?php 
	require("connect.php");

	require("authenticate.php");
 
 //DELETE games
	$id = filter_input(INPUT_GET, 'game_id', FILTER_SANITIZE_NUMBER_INT);
	$query = "DELETE FROM games WHERE game_id = :game_id LIMIT 1";
	$statement = $db->prepare($query);
	$statement->bindValue(':game_id', $id, PDO::PARAM_INT);
	$statement->execute();

//DELETE reviews
	$comment = filter_input(INPUT_GET, 'comment_id', FILTER_SANITIZE_NUMBER_INT);
	$query2 = "DELETE FROM games_comments WHERE comment_id = :comment_id LIMIT 1";
	$statement2 = $db->prepare($query2);
	$statement2->bindValue(':comment_id', $comment, PDO::PARAM_INT);
	$statement2->execute();

//DELETE users
	$user = filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT);
	$query3 = "DELETE FROM users WHERE user_id = :user_id LIMIT 1";
	$statement3 = $db->prepare($query3);
	$statement3->bindValue(':user_id', $user, PDO::PARAM_INT);
	$statement3->execute();

	header("Location: admin.php");
	exit;
?>