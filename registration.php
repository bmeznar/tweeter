<!DOCTYPE html>
<html lang="sl" dir="ltr">
  <head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twetter Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login.css">
  </head>
  <body>
    <div class="login_box">
    <form class="registration" action="registration_verify.php" method="post">
      <input type="email" name="email" value="" placeholder="E-mail" required><br>
      <input type="text" name="username" value="" placeholder="Username" required><br>
      <input type="text" name="name" value="" placeholder="Name and surname" required><br>
      <input type="password" name="password1" value="" placeholder="Password" required><br>
      <input type="password" name="password2" value="" placeholder="Re-enter password" required><br>
      Birthday: <input type="date" name="birth" value="" required><br>
      <input type="submit" name="submit" value="Register"></div>
      <br>
      <?php session_start();
       if(isset($_SESSION['register_feedback'])){
        echo $_SESSION['register_feedback'];
        $_SESSION['register_feedback']=null;
      } ?>
    </form>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
