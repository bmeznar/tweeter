<?php
  include 'sql.php';
  session_start();
  $user=$_SESSION['id'];
  $following=$_POST['id'];
  $query = "DELETE FROM following WHERE user_id=? AND follower_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$user,$following]);
  $pdo=null;
  header("Location:index.php");
?>
