<?php
  include 'sql.php';
  session_start();
  $post=$_POST['id'];
  $stmt = $pdo->prepare("DELETE FROM likes WHERE post_id=? AND user_id=?");
  $stmt->execute([$post,$_SESSION['id']]);
  $deleted = $stmt->rowCount();
  header("Location:index.php#post".$_POST['post']);
?>
