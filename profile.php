<!DOCTYPE html>
<html lang="sl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php include 'header.php';
        include 'sql.php';
        echo "<div class='profile'>";
        $id=$_GET['id'];
        $stmt = $pdo->query("SELECT * FROM users WHERE id=$id");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
          echo "<h4>".$row['name']."</h4><br>\n";
          echo $row['username']."<br>";
          echo $row['bio']."<br>";
          $date = strtotime($row['birthday']);
          echo "Birthday: ".date('d/m/Y',$date)."<br>";
          echo "<form method='post'><input type='hidden' value='$id' name='id'>";
          echo "<br><button type='submit' formaction='follow_verify.php'>Follow</button></form><br>";
        }
        $stmt = $pdo->query("SELECT * FROM posts AS p INNER JOIN users AS u WHERE p.user_id=$id ORDER BY date DESC");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
          echo "<div class='posts' style='border:1px solid black'>";
          echo "<h3 class='name'>".$row['name']."</h3>";
          echo "<h5 class='username'>".$row['username']."</h4>";
          echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['date']))."</h5><br>";
          echo "<p class='description'>".$row['description']."</p>";
          echo "</div><br>";
        }
        $pdo=null;
        echo "</div>";
    ?>
  </body>
</html>
