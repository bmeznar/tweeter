<?php
  include 'sql.php';
  $comment=$_POST['comment'];
  $post_id=$_GET['post_id'];
  session_start();
  $sql = "INSERT INTO comments (text, post_id, user_id) VALUES (?,?,?)";
  $pdo->prepare($sql)->execute([$comment, $post_id, $_SESSION['id']]);
  header('Location:index.php#post'.$_POST['post']);
?>
