<?php
	require("connect.php");

	session_start();

	if(isset($_POST['loginBtn'])) {
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	    $query = "SELECT * FROM users WHERE email = :email";

	    $statement = $db->prepare($query);

	    $statement->bindValue(':email', $email);

	    $statement->execute();

	    // $row is currently returning false 
	    $row = $statement->fetch();

	    if($row === true) {
			$_SESSION['user_id'] = $user['user_id'];
    		$_SESSION['logged_in'] = time();

    		header("Location:index.php");
	    }else {
    		echo "Incorrect Information";
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
		<label for="email" id="email">Email:</label>
		<input type="email" id="email" placeholder="example@gmail.com">
		<br>
		<br>
		<label for="password" id="password">Password:</label>
		<input type="password" name="password" placeholder="********">
		<br>
		<br>
		<button type="submit" name="loginBtn">Log In</button>
	</form>
	<br>
	<a href="createAccount.php">Don't have an account?</a>
	</div>
</body>
</html>