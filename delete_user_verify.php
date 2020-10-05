<?php
  session_start();
  include 'sql.php';
  $post_id=$_GET['id'];
  $stmt = $pdo->prepare("SELECT i.url AS url FROM images AS i INNER JOIN posts AS p ON p.id=i.post_id INNER JOIN users AS u ON u.id=p.user_id WHERE u.id= :id");
  $stmt->execute(['id'=> $post_id]);
  $data = $stmt->fetchAll();
  foreach ($data as $row) {
    $filename=basename($row['url']);
    $dir = "uploads";
    (unlink($dir.'/'.$filename));
  }

  $query = "DELETE FROM images WHERE post_id IN (SELECT id FROM posts WHERE user_id=?)";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $query = "DELETE FROM comments WHERE user_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $query = "DELETE FROM likes WHERE user_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $query = "DELETE FROM retweet WHERE user_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $query = "DELETE FROM pinned WHERE user_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $query = "DELETE FROM posts WHERE user_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $query = "DELETE FROM following WHERE user_id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $query = "DELETE FROM users WHERE id=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$post_id]);
  $pdo=null;
  header("Location:admin_search.php");
?>

?>
