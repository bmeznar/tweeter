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
      if(isset($_POST['slika'])){
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["slika"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // preverite ali je datoteka v resnici slika ali je ponarejena slika
        if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["slika"]["tmp_name"]);
          if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
          } else {
            $_SESSION['profile_update_status']="<div class='update_status_fail'>Sorry your file is not an image.</div>";
            $uploadOk = 0;
          }
        }
        // preverite, če datoteka že obstaja
        if (file_exists($target_file)) {
          $_SESSION['profile_update_status']="<div class='update_status_fail'>Sorry your file already exists.</div>";
          $uploadOk = 0;
        }
        // preverite velikost datoteke
        if ($_FILES["slika"]["size"] > 5000000) {
          $_SESSION['profile_update_status']="<div class='update_status_fail'>Sorry your file is too large.</div>";
          $uploadOk = 0;
        }
        // preverite tipe datotek
        if($imageFileType !="jpg" && $imageFileType !="png" && $imageFileType !="jpeg") {
        $_SESSION['profile_update_status']="<div class='update_status_fail'>Sorry only JPG, JPEG and PNG allowed.</div>";
        $uploadOk = 0;
      }
      // preverite, če je $uploadOk postavljena na 0 (zaradi napake)
      if ($uploadOk == 0) {
        //$_SESSION['profile_update_status']="<div class='update_status_fail'>Sorry your file was not uploaded.</div>";
        //header("Location: profile_settings.php");
        // če je vse v redu, se poskuša datoteko naložiti
      } else {
        if (move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file)) {

            echo "The file ". basename( $_FILES["slika"]["name"]). " has been uploaded.";
            $st=0;
            $result = $pdo->prepare("SELECT * FROM `users` WHERE (`username`=? OR `email`=?) AND `id`!=?");
            $result->execute(array($username,$email,$_SESSION['id']));
            foreach($result as $row) {
              $st++;
            }
            if($st==0){
              $sql = "UPDATE users SET name=?, username=?, email=?, bio=?, birthday=?, avatar=? WHERE id=?";
              $stmt= $pdo->prepare($sql);
              $stmt->execute([$name, $username, $email,$bio,$birthday,$target_file, $_SESSION['id']]);
              $_SESSION['username']=$username;
              $_SESSION['email']=$email;
              $_SESSION['name']=$name;
              $_SESSION['avatar']=$target_file;
              $_SESSION['profile_update_status']="<div class='update_status_success'>Successfully updated!</div>";
              header("Location: profile_settings.php");
            }
            else{
              $_SESSION['profile_update_status']="<div class='update_status_fail'>Userame or email already exists.</div>";
              header("Location: profile_settings.php");
            }
        } else {
          $_SESSION['profile_update_status']="<div class='update_status_fail'>There was an error uploading you photo.</div>";
          header("Location: profile_settings.php");
        }
      }



        }
        else{
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
            $_SESSION['profile_update_status']="<div class='update_status_success'>Successfully updated!</div>";
            header("Location: profile_settings.php");

        }
      }
      
  }
  else {
    $_SESSION['profile_update_status']="<div class='update_status_fail'>Please enter all the information.</div>";
      header("Location: profile_settings.php");
  }
?>
