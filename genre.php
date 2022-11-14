<?php 
	require('connect.php');

	$query = "SELECT * FROM games ORDER BY game_id DESC";

	$statement = $db->prepare($query);

	$statement->execute();


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<?php 
		include("nav.php")
	?>
	<ul>
		<?php while($row = $statement->fetch()): ?>
			<li><?= $row['genre'] ?></a></li>
		<?php endwhile ?>
	</ul>

</body>
</html>