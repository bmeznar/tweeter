<?php
    session_start();
    if(isset($_SESSION['username'])){
      //include stran s posti
    }
    else{
      header('Location:login.php');
    }
 ?>
