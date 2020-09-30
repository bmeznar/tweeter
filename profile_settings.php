<!DOCTYPE html>
<html lang="sl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php include 'header.php'; ?>
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
        echo "Upload profile picture:<input type='file' name='slika' value=''><br>";
      ?>
      <input type="submit" name="submit" value="Update">
    </form>
    <hr>
    <form class="password" action="pass_change_verify.php" method="post">
      <input type="password" name="pass1" value="" placeholder="Change password"><br>
      <input type="password" name="pass2" value="" placeholder="Repeat password"><br>
      <input type="submit" name="submit" value="Change password">
    </form>
  </body>
</html>
