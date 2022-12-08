<?php 
	require("connect.php");

	session_start();

	if ($_POST && !empty($_POST['email']) && !empty($_POST['password'])) {
		$name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $query = "INSERT INTO users (first_name, email, password) VALUES (:first_name,:email, :password)";
        $statement = $db->prepare($query);

        $statement->bindValue(':first_name', $name);
        $statement->bindValue(':email', $email);
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
		<label for="first_name" id="first_name">Enter Your First Name:</label>
		<input type="text" name="first_name">
		<br>
		<br>
		<label for="email" id="email">Enter a Valid Email Address:</label>
		<input type="email" name="email" placeholder="example@gmail.com">
		<br>
		<br>
		<label for="password" id="password">Create a Password:</label>
		<input type="password" name="password">
		<br>
		<br>
		<button type="submit">Create Account</button>
	</form>
	<?php if (empty($name)): ?>
		<h5>Must enter a name.</h5>	
	<?php endif ?>
	<?php if (empty($email)): ?>
			<h5>Must enter a valid email.</h5>	
	<?php endif ?>
	<?php if (empty($password)): ?>
		<h5>Must enter a password.</h5>	
	<?php endif ?>
	</div>
</body>
</html>
