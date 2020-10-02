<?php
include 'sql.php';
  session_start();
  $post=$_POST['id'];
  $sql = "INSERT INTO likes (post_id,user_id) VALUES (?,?)";
  $pdo->prepare($sql)->execute([$post,$_SESSION['id']]);
  header("Location:index.php#post".$_POST['post']);
 ?>
