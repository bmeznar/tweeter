<?php
  session_start();
  include 'sql.php';
  $post_id=$_GET['id'];
  $stmt = $pdo->prepare("SELECT * FROM images WHERE post_id= :id");
  $stmt->execute(['id'=> $post_id]);
  $data = $stmt->fetchAll();
  foreach ($data as $row) {
    $filename=basename($row['url']);
    $dir = "uploads";
    (unlink($dir.'/'.$filename));
  }

  $query = "DELETE FROM images WHERE post_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $query = "DELETE FROM comments WHERE post_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $query = "DELETE FROM likes WHERE post_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $query = "DELETE FROM retweet WHERE post_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $query = "DELETE FROM pinned WHERE post_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $query = "DELETE FROM posts WHERE id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $pdo=null;
  header("Location:myprofile.php");
?>
