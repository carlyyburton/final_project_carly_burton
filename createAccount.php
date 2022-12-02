<?php 
	require("connect.php");

	if ($_POST && !empty($_POST['username']) && !empty($_POST['password'])) {
		$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $query = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $statement = $db->prepare($query);
        
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', $password);
         
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
	<title>Create an Account</title>
</head>
<body>
	<?php 
		include("nav.php");
	?>
	<div id="account">
		<h4>Create an Account</h4>
		<br>
	<form action="createAccount.php"
		  method="post"
		  id="createAccount">
		<label for="username" id="username">Create a Username</label>
		<input type="text" name="username">
		<p>(Username must be 10 characters or less)</p>
		<br>
		<label for="password" id="password">Create a Password</label>
		<input type="password" name="password">
		<br>
		<br>
		<button type="submit">Create Account</button>
	</form>
	</div>
</body>
</html>
