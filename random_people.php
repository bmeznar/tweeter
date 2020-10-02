<?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  include 'sql.php';
  $stmt = $pdo->prepare("SELECT * FROM users WHERE id!=:id ORDER BY RAND() LIMIT 5");
  $stmt->execute(['id'=>$_SESSION['id']]);
  $data = $stmt->fetchAll();
  foreach ($data as $row) {
    echo "<div class='user_random'>";
    echo "<img src='".$row['avatar']."' alt='avatar'>";
    echo "<p>".$row['name']." <a href=profile.php?id=".$row['id'].">@".$row['username']."</a></p>";
    echo "</div>";
  }
?>
