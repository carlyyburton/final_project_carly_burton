<?php 
	require("connect.php");

	if ($_POST && !empty($_POST['email']) && !empty($_POST['password'])) {
		$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $query = "INSERT INTO users (email, password) VALUES (:email, :password)";
        $statement = $db->prepare($query);
        
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
	<?php if (empty($email)): ?>
			<h5>Must enter a valid email.</h5>	
	<?php endif ?>
	<?php if (empty($password)): ?>
		<h5>Must enter a password.</h5>	
	<?php endif ?>
	</div>
</body>
</html>
