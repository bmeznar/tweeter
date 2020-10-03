<?php
  include 'sql.php';
  $comment=$_POST['comment'];
  $post_id=$_GET['post_id'];
  session_start();
  $sql = "INSERT INTO comments (text, post_id, user_id) VALUES (?,?,?)";
  $pdo->prepare($sql)->execute([$comment, $post_id, $_SESSION['id']]);
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
