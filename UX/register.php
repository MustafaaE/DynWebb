<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <title>Registration Form - 30DaysOfCSS3</title> 
	 <link href="https://fonts.googleapis.com/css?family=Bubblegum+Sans|Nova+Mono|Roboto+Condensed" rel="stylesheet">
	 <link href="https://fonts.googleapis.com/css?family=Parisienne&display=swap" rel="stylesheet">
   <link href="styles.css" rel="stylesheet">
 </head>
 <body>
	<h1>Register</h1>
	<div class="content">
	<section>
		<div class="register-wrapper">
		<div class="register-block">
		<h3 class="register-title">Create an account</h3>
		<form action="../interface/register_user.php" method="POST">
        <input type="text" placeholder="email" name="email" required>
        <input type="text" placeholder="username" name="username" required>
        <input type="text" placeholder="password" name="password" required>
        <input type="submit">
		<a href ="login.php"> Back</a>
		</div>
		</div>
	</section>
</div>
	<footer>
	</footer>
</body>
</html>

