 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Birdie</title>
     <link rel="stylesheet" href="/css/index.css">
   </head>
   <body>
     <?php include 'header.php'; ?>
     <div class="search">
       <form class="searchbar" action="search.php" method="post">
         <input type="text" name="search" value="" placeholder="search" required><br>
         <input type="submit" name="submit" value="Search">
       </form>
       <br>
     </div>
     <?php
     if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
     if(isset($_POST['search'])){
       include 'sql.php';
       $search="%".$_POST['search']."%";
      $result = $pdo->prepare("SELECT * FROM `users` WHERE (`name` LIKE ? OR `username` LIKE ?) AND id!=?");
      $result->execute(array($search,$search,$_SESSION['id']));
      foreach($result as $row) {
        echo $row['name']." @".$row['username']." <a href='profile.php?id=".$row['id']."'>Show profile</a><br>";
      }
     }
      ?>
   </body>
 </html>
