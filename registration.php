<!DOCTYPE html>
<html lang="sl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Twetter Registration</title>
  </head>
  <body>
    <form class="registration" action="registration_verify.php" method="post">
      <input type="email" name="email" value="" placeholder="E-mail" required><br>
      <input type="text" name="username" value="" placeholder="Username" required><br>
      <input type="text" name="name" value="" placeholder="Name and surname" required><br>
      <input type="password" name="password1" value="" placeholder="Password" required><br>
      <input type="password" name="password2" value="" placeholder="Re-enter password" required><br>
      Birthday: <input type="date" name="birth" value="" required><br>
      <input type="submit" name="submit" value="Register">
    </form>
  </body>
</html>
