<?php
  include 'sql.php';
  $stmt = $pdo->query("SELECT * FROM posts AS p INNER JOIN users AS u ON u.id=p.user_id ORDER BY date DESC");
  $stmt->execute();
  while ($row = $stmt->fetch()) {
    echo "<div class='posts' style='border:1px solid black'>";
    echo "<h3 class='name'>".$row['name']."</h3>";
    echo "<h5 class='username'>@".$row['username']."</h4>";
    echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['date']))."</h5><br>";
    echo "<p class='description'>".$row['description']."</p>";
    echo "</div><br>";
  }
  $pdo=null;
?>
