<?php
  include 'sql.php';
  session_start();
  $post_id=$_GET['id'];
  $query = "DELETE FROM posts WHERE id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $pdo=null;
  header("Location:myprofile.php");
?>
