<!DOCTYPE html>
<html lang="sl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Twetter</title>
  </head>
  <body>
    <?php
        session_start();
        if(isset($_SESSION['username'])){
          include 'header.php';
          include 'posts.php';
          //include stran s posti
        }
        else{
          header('Location:login.php');
        }
     ?>
  </body>
</html>
