<?php 

session_start();

if (isset($_SESSION['user_id'])) {
	header("index.php");
}

require 'database.php';

if(!empty($_POST['email']) && !empty($_POST['password'])):
	
	$records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){

		$_SESSION['user_id'] = $results['id'];
		header("Location /");
	} else {
		$message = 'Sorry, those credentials do not match';
	}
endif;

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet"> 
	<title>Login Below</title>
</head>
<body>
	<div class="header">
	<a href="index.php">Your App Name</a>	
	</div>

	<?php if(!empty($message)): ?>
	<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Login</h1>
	<span>or <a href="register.php">register here</a></span>

	<form action="login.php" method="POST">
		<input type="text" placeholder="Enter your email" name="email">
		<input type="password" placeholder="and password" name="password">
		<input type="submit">

	</form>
</body>
</html>