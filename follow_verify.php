<?php
  include 'sql.php';
  session_start();
  $user=$_SESSION['id'];
  $following=$_POST['id'];
  $query = "INSERT INTO following(user_id,follower_id) VALUES(?,?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$user,$following]);
  $pdo=null;
  header("Location:profile.php?id=".$following);
?>
