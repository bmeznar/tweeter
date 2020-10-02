<?php
  session_start();
  include 'sql.php';

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
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    // preverite, če datoteka že obstaja
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    // preverite velikost datoteke
    if ($_FILES["slika"]["size"] > 5000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    // preverite tipe datotek
    if($imageFileType !="jpg" && $imageFileType !="png" && $imageFileType !="jpeg" && $imageFileType !="gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  // preverite, če je $uploadOk postavljena na 0 (zaradi napake)
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // če je vse v redu, se poskuša datoteko naložiti
  } else {
    if (move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file)) {

        echo "The file ". basename( $_FILES["slika"]["name"]). " has been uploaded.";
        $stmt= $pdo->prepare("INSERT INTO posts (description,user_id) VALUES (?,?)");
        $stmt->execute([$_POST['description'], $_SESSION['id']]);
        $lastId = $pdo->lastInsertId();
        $stmt= $pdo->prepare("INSERT INTO images (url,post_id) VALUES (?,?)");
        $stmt->execute([$target_file, $lastId]);
        header('Location:index.php');
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
  }

  else{
    $stmt= $pdo->prepare("INSERT INTO posts (description,user_id) VALUES (?,?)");
    $stmt->execute([$_POST['description'], $_SESSION['id']]);
    header('Location:index.php');
  }
 ?>
