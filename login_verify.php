<?php
  session_start();
  include 'sql.php';
  $user=$_POST['username'];
  $pass=$_POST['password'];

  $query = "SELECT * FROM users WHERE email=? OR username=?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([$user,$user]);

  if($stmt->rowCount()==1){
    $row = $stmt->fetch();
    if (password_verify($pass, $row['password'])) {
        $_SESSION['username']=$row['username'];
        $_SESSION['email']=$row['email'];
        $_SESSION['avatar']=$row['avatar'];
        $_SESSION['name']=$row['name'];
        header("Location:index.php");
        die();
        }
        else{
          echo "napaka";
        }
  }
  else{
    echo "Napaka.";
    header("Location: login.php");
  }
?>
