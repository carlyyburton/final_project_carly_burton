<?php 
	require('connect.php');

	session_start();

	if ($_POST && !empty($_POST['first_name']) && !empty($_POST['email']) && !empty($_POST['password'])) {

		$id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
		$name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$query = "UPDATE users SET first_name = :first_name, email = :email, password = :password WHERE user_id = :user_id LIMIT 1";

		$statement = $db->prepare($query);

		$statement->bindValue(':user_id', $id);
		$statement->bindValue(':first_name', $name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);

		$statement->execute();

		header("Location: index.php");
		exit;
	}
	elseif (!empty($_GET['user_id'])) {
		$id = filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT);

		$query = "SELECT * FROM users WHERE user_id = :user_id";

		$statement = $db->prepare($query);
		$statement->bindValue(':user_id', $id, PDO::PARAM_INT);

		$statement->execute();
		$users = $statement->fetch();
	}
	else{
		$id = false;
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Users</title>
</head>
<body>
	<?php 
		include("nav.php")
	?>
	<div id="updateUsers">
	<?php if($id): ?>
		<h3>Edit User</h3>
		<br>
		<form method="post"
			  id="editUsers"
			  action="editUsers.php">
			<input type="hidden" name="user_id" value="<?= $users['user_id'] ?>">

			<label for="first_name">First Name:</label>
			<input type="text" name="first_name" id="first_name" value="<?= $users['first_name'] ?>">
			<br>
			<br>
			<label for="email">Email Address:</label>
			<input type="email" name="email" id="email" value="<?= $users['email'] ?>">
			<br>
			<br>
			<label for="password">Password:</label>
			<input type="text" name="password" id="password" value="<?= $users['password'] ?>">
			<br>
			<br>
			<button type="submit">Update</button>
			<button type="submit" formaction="admin.php">Cancel</button>	
		</form>
	<?php endif ?>
	</div>
</body>
</html>