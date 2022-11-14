<?php 
	require('connect.php');
 
	$id = filter_input(INPUT_POST, 'game_id', FILTER_SANITIZE_NUMBER_INT);

	$query = "DELETE FROM games WHERE game_id = :game_id";

	$statement = $db->prepare($query);

	$statement->bindValue(':game_id', $id, PDO::PARAM_INT);

	$statement->execute();

	header("Location: index.php");
	exit;
?>