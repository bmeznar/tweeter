<?php
  session_start();
  include 'sql.php';
  $stmt= $pdo->prepare("INSERT INTO posts (description,user_id) VALUES (?,?)");
  $stmt->execute([$_POST['description'], $_SESSION['id']]);
  header('Location:index.php');
 ?>
