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
        //session_start();
        $id=$_SESSION['id'];
        $stmt = $pdo->query("SELECT * FROM users WHERE id=$id");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
          echo "<h4>".$row['name']."</h4><br>\n";
          echo "@".$row['username']."<br>";
          echo $row['bio']."<br>";
          $date = strtotime($row['birthday']);
          echo "Birthday: ".date('d/m/Y',$date)."<br>";
          echo "<a href='profile_settings.php'>Profile Settings</a>";
        }
        $stmt = $pdo->query("SELECT u.name AS name,u.username AS username,p.date AS pdate,p.description AS description, p.id AS id, i.url AS url,COUNT(l.id) AS likes FROM posts AS p INNER JOIN users AS u ON u.id=p.user_id LEFT JOIN images AS i ON i.post_id=p.id
        LEFT JOIN likes AS l ON l.post_id=p.id WHERE p.user_id=$id GROUP BY p.id ORDER BY date DESC");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
          if(isset($row['url'])){
            echo "<div class='posts' style='border:1px solid black'>";
            echo "<h3 class='name'>".$row['name']."</h3>";
            echo "<h5 class='username'>@".$row['username']."</h4>";
            echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5><br>";
            echo "<p class='description'>".$row['description']."</p>";
            echo "<div class='post_img'><img src='".$row['url']."' alt='image'></div>";
            echo "<div class='bottom_bar'><a href='like.php'>Like</a>".$row['likes'];
            echo "<br><a href='delete_post_verify.php?id=".$row['id']."'>Delete Post</a></div><br>";
            echo "</div></div><br>";
          }
          else{
            echo "<div class='posts' style='border:1px solid black'>";
            echo "<h3 class='name'>".$row['name']."</h3>";
            echo "<h5 class='username'>@".$row['username']."</h4>";
            echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5><br>";
            echo "<p class='description'>".$row['description']."</p>";
            echo "<div class='bottom_bar'><a href='like.php'>Like</a>".$row['likes'];
            echo "<br><a href='delete_post_verify.php?id=".$row['id']."'>Delete Post</a></div><br>";
            echo "</div></div><br>";
          }
        }
        $pdo=null;
        echo "</div>";
    ?>
  </body>
</html>
