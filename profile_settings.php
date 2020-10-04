<!DOCTYPE html>
<html lang="sl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birdie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/profile_edit.css">
  </head>
  <body>
    <?php include 'header.php'; ?>
    <div class="profile_edit">
    <form class="edit" action="profile_settings_verify.php" enctype="multipart/form-data" method="post">
      <h3>Edit your profile</h3>
      <?php
        include 'sql.php';
        if (session_status() == PHP_SESSION_NONE) {
          session_start();
        }
        $stmt = $pdo->query("SELECT * FROM users WHERE id=".$_SESSION['id']."");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
          $bio=$row['bio'];
          $birthday=$row['birthday'];
        }
        echo "<input type='text' name='name' value='".$_SESSION['name']."'><br>";
        echo "<input type='text' name='username' value='".$_SESSION['username']."'><br>";
        echo "<input type='text' name='bio' value='".$bio."' placeholder='Your Bio'><br>";
        echo "<input type='email' name='email' value='".$_SESSION['email']."'><br>";
        echo "<input type='date' name='birthday' value='".date("Y-m-d", strtotime($birthday))."'><br>";
        echo "Change profile picture:<br><input type='file' name='slika' value=''><br>";
      ?>
      <input type="submit" name="submit" value="Update">
    </form><br>
    <hr>
    <form class="password" action="pass_change_verify.php" method="post">
      <input type="password" name="pass1" value="" placeholder="Change password"><br>
      <input type="password" name="pass2" value="" placeholder="Repeat password"><br>
      <input type="submit" name="submit" value="Change password">
    </form>
    <?php
      if(isset($_SESSION['profile_update_status'])){
        echo $_SESSION['profile_update_status'];
        $_SESSION['profile_update_status']=null;
      }
    ?>
  </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
