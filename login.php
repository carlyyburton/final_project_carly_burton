<?php
	require("connect.php");

	session_start();

	if(isset($_POST['loginBtn'])) {
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

	    $query = "SELECT * FROM users WHERE email = :email AND password = :password";

	    $statement = $db->prepare($query);

	    $statement->bindValue(':email', $email);
	    $statement->bindValue(':password', $password);
	    $statement->execute();
 
	    $row = $statement->fetch();

	    if($row) {
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['first_name'] = $row['first_name'];
    		$_SESSION['logged_in'] = time() + 60*60;

    		header("Location:index.php");
	    }else {
			echo "Incorrect Information";
	    }
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php
		include("nav.php");
	?>
	<div id="login">
	<h3>Log In</h3>
	<br>
	<form action="login.php"
		  method="post"
		  id="loginForm">
		<label for="email">Email:</label>
		<input type="email" id="email" name="email" placeholder="example@gmail.com">
		<br>
		<br>
		<label for="password">Password:</label>
		<input type="password" id="password" name="password" placeholder="********">
		<br>
		<br>
		<button type="submit" name="loginBtn">Log In</button>
	</form>
	<br>
	<a href="createAccount.php">Don't have an account?</a>
	</div>
</body>
</html>