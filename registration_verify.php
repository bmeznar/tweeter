<?php
include_once 'sql.php';

$name = $_POST['name'];
$email = $_POST['email'];
$birthday = $_POST['birth'];
$username = $_POST['username'];
$pass1 = $_POST['password1'];
$pass2 = $_POST['password2'];
//preverim podatke, da so obvezi vnešeni
if (!empty($name) && !empty($email)
        && !empty($birthday) && !empty($username)
        && !empty($pass1)
        && ($pass1 == $pass2)) {
    $st=0;
    $result = $pdo->prepare("SELECT * FROM `users` WHERE `username`=? OR `email`=?");
    $result->execute(array($username,$email));
    foreach($result as $row) {
      $st++;
    }
    if($st==0){
      $pass = password_hash($pass1, PASSWORD_DEFAULT);

      $query = "INSERT INTO users (username,name,email,birthday,password) VALUES (?,?,?,?,?)";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$username,$name,$email,$birthday,$pass]);
      session_start();
      $_SESSION['username']=$username;
      $_SESSION['email']=$email;
      $_SESSION['name']=$name;
      $lastId = $pdo->lastInsertId();
      $_SESSION['id']=$lastId;
      $_SESSION['avatar']='uploads/default_profile.png';
      $query = "INSERT INTO following (user_id,follower_id) VALUES (?,?)";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$lastId,$lastId]);
      header("Location: index.php");
    }
    else{
      header("Location: registration.php");
    }
}
else {
    header("Location: registration.php");
}
?>
