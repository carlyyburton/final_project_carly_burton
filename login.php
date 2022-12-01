<?php
	require("connect.php");

	session_start();

	if(isset($_POST['username']) && isset($_POST['password'])) {
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$query = "SELECT * FROM users WHERE username = :username AND password = :password";

		$statement = $db->prepare($query);

	    $statement->bindValue(':username', $username);
	    $statement->bindValue(':password', $password);

	    if ($statement->execute()) {
            echo "Logged In";
        }
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log In</title>
</head>
<body>
	<?php
		include("nav.php");
	?>
	<div id="login">
	<h4>Log In</h4>
	<br>
	<form action="login.php"
		  method="post"
		  id="loginForm">
		<label for="username" id="username">Username:</label>
		<input type="text" id="username" placeholder="username">
		<br>
		<br>
		<label for="password" id="password">Password:</label>
		<input type="text" name="password" placeholder="********">
		<br>
		<br>
		<button>Log In</button>
	</form>
	<br>
	<a href="createAccount.php">Don't have an account?</a>


	</div>
</body>
</html>