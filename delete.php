<?php 
	require("connect.php");

	require("authenticate.php");
 
	$id = filter_input(INPUT_GET, 'game_id', FILTER_SANITIZE_NUMBER_INT);

	$comment = filter_input(INPUT_GET, 'comment_id', FILTER_SANITIZE_NUMBER_INT);

	$query = "DELETE FROM games WHERE game_id = :game_id LIMIT 1";

	$query2 = "DELETE FROM games_comments WHERE comment_id = :comment_id LIMIT 1";

	$statement = $db->prepare($query);

	$statement2 = $db->prepare($query2);

	$statement->bindValue(':game_id', $id, PDO::PARAM_INT);

	$statement2->bindValue(':comment_id', $comment);

	$statement->execute();

	$statement2->execute();

	header("Location: admin.php");
	exit;
?>