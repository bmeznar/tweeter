<?php
  include 'sql.php';
  $query = "DELETE FROM comments WHERE id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$_GET['id']]);
  header("Location:admin.php");
 ?>
