<?php
  include 'sql.php';
  session_start();
  $post=$_POST['id'];
  $sql = "INSERT INTO pinned (post_id,user_id) VALUES (?,?)";
  $pdo->prepare($sql)->execute([$post,$_SESSION['id']]);
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
