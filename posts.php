<?php
  //session_start();
  include 'sql.php';
  $stmt = $pdo->query("SELECT p.id AS id,u.name AS name,u.username AS username,p.date AS date,p.user_id AS user_id,p.description AS description FROM posts AS p INNER JOIN users AS u ON u.id=p.user_id INNER JOIN following AS f ON f.user_id=u.id WHERE p.user_id=u.id ORDER BY date DESC");
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    $post_id=$row['id'];
    echo "<div class='posts' style='border:1px solid black'>";
    echo "<h3 class='name'>".$row['name']."</h3>";
    echo "<h5 class='username'><a href='profile.php?id=".$row['user_id']."'>@".$row['username']."</a></h4>";
    echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['date']))."</h5><br>";
    echo "<p class='description'>".$row['description']."</p>";
    echo "</div><br>";
  }
  $pdo=null;
?>
