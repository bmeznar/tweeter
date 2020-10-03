<?php
  include 'sql.php';
  session_start();
  $post=$_POST['id'];
  $stmt = $pdo->prepare("DELETE FROM retweet WHERE post_id=? AND user_id=?");
  $stmt->execute([$post,$_SESSION['id']]);
  $deleted = $stmt->rowCount();
  if(isset($_SESSION['original'])){
    if($_SESSION['original']=='myprofile.php'){
      $_SESSION['original']=null;
      header("Location:myprofile.php#post".$_POST['post']);
    }
    if($_SESSION['original']=='profile.php'){
      $_SESSION['original']=null;
      header("Location:profile.php#post".$_POST['post']);
    }
  }
  else{
      header("Location:index.php#post".$_POST['post']);
  }
?>
