<!DOCTYPE html>
<html lang="sl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Twetter Login</title>
  </head>
  <body>
    <form class="login" action="login_verify.php" method="post">
      <input type="text" name="username" value="" placeholder="Username" required><br>
      <input type="password" name="password" value="" placeholder="Password" required><br>
      <input type="submit" name="login" value="Login">
      <br><a href="registration.php">Register</a>
    </form>
  </body>
</html>
