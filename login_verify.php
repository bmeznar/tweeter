<?php
  session_start();
  include 'sql.php';
  $user=$_POST['username'];
  $pass=$_POST['password'];
  $password=password_verify($pass,PASSWORD_DEFAULT);

  $stmt = $pdo->query("SELECT * FROM users WHERE (email='".$user."' OR username='".$user."') AND password='".$password."'");
  $count=0;
  while ($row = $stmt->fetch()) {
      $count++;
      $_SESSION['username']=$row['username'];
      $_SESSION['email']=$row['email'];
      $_SESSION['avatar']=$row['avatar'];
      $_SESSION['name']=$row['name'];
  }

  if($count===1){
      header('Location:index.php')
  }
  else{
    echo "Napaka.";
    header('Location: login.php')
  }
?>
