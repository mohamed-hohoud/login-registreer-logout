<?php 

session_start();

require 'database.php';

if (isset($_SESSION['user_id'])) {
	
	$records = $conn->prepare('SELECT id,email,password FROM users WHERE id = :id');
	$records->bindParam(':id', $_SESSION['user_id']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$user = NULL;

	if( count($results) > 0){
		$user = $results;
	}
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet"> 
    <title>Welcome to your web app</title>
</head>
    <body>

    <div class="header">
	<a href="index.php">Your App Name</a>	
	</div>

	<?php if(!empty($user)): ?>

		<br/>Welcome <?= $user['email']; ?>
		<br /><br /> You are successfully logged in!
		<br /><br />

		<a href="logout.php">Logout?</a>

	<?php else: ?>

      <h1>Please Login or Register</h1>
      <a href="login.php">Login</a> or
      <a href="register.php">Register</a>

  <?php endif; ?>
    </body>
</html>
