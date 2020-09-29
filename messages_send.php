<?php
  session_start();
  include 'sql.php';
  $message=$_POST['message'];
  $reciever_id=$_POST['reciever'];
  $sql = "INSERT INTO message_user (sender_id,receiver_id,message) VALUES (?,?,?)";
  $stmt= $pdo->prepare($sql);
  $stmt->execute([$_SESSION['id'],$reciever_id,$message]);
  $pdo=null;
  header['Location:messages.php'];
?>
