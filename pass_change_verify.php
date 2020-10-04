<?php
  include 'sql.php';
  session_start();
  if(isset($_POST['pass1']) AND isset($_POST['pass2'])){
    if($_POST['pass1']==$_POST['pass2']){
      $pass = password_hash($_POST['pass1'], PASSWORD_DEFAULT);
      $sql = "UPDATE users SET name=? WHERE id=?";
      $stmt= $pdo->prepare($sql);
      $stmt->execute([$pass, $_SESSION['id']]);
      $_SESSION['profile_update_status']="<div class='update_status_success'>Successfully updated!</div>";
      header("Location: profile_settings.php");
    }
    else{
      $_SESSION['profile_update_status']="<div class='update_status_fail'>Entered Passwords don't match.</div>";
      header("Location:profile_settings.php");
    }
  }
  else{
    $_SESSION['profile_update_status']="<div class='update_status_fail'>Please fill out both fields.</div>";
    header("Location:profile_settings.php");
  }
?>
