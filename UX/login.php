<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Login Page</title>
</head>
<body>
<div class="wrapper">
  <div class="container">
    <div class="col-left">
      <div class="login-form">
        <h2>Login</h2>
        <form action="../interface/login_user.php" method="POST">
          <p>
            <input type="text" placeholder="username" name="username" required>
          </p>
          <p>
            <input type="password" placeholder="Password" name="password" required>
          </p>
          <p>
            <input class="btn" type="submit" value="Sign In" />
          </p>
          <p>
            <a href="">Forget Password?</a>
          </p>
          <a href ="register.php"> Create Account</a>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>