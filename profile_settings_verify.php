<?php
  session_start();
  include 'sql.php';
  $name=$_POST['name'];
  $username=$_POST['username'];
  $bio=$_POST['bio'];
  $email=$_POST['email'];
  $birthday=$_POST['birthday'];
  if (!empty($name) && !empty($email)
      && !empty($birthday) && !empty($username)) {
      $st=0;
      $result = $pdo->prepare("SELECT * FROM `users` WHERE (`username`=? OR `email`=?) AND `id`!=?");
      $result->execute(array($username,$email,$_SESSION['id']));
      foreach($result as $row) {
        $st++;
      }
      if($st==0){
        $sql = "UPDATE users SET name=?, username=?, email=?, bio=?, birthday=? WHERE id=?";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$name, $username, $email,$bio,$birthday, $_SESSION['id']]);
        $_SESSION['username']=$username;
        $_SESSION['email']=$email;
        $_SESSION['name']=$name;
        header("Location: myprofile.php");
      }
      else{
        header("Location: profile_settings.php");
      }
  }
  else {
      header("Location: profile_settings.php");
  }
?>
