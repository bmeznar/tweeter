 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
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
     if(isset($_POST['search'])){
       include 'sql.php';
       $search="%".$_POST['search']."%";
      $result = $pdo->prepare("SELECT * FROM `users` WHERE `name` LIKE ? OR `username` LIKE ?");
      $result->execute(array($search,$search));
      foreach($result as $row) {
        echo $row['name']." ".$row['username']." <a href='profile.php?id=".$row['id']."'>Show profile</a>";
      }
     }
      ?>
   </body>
 </html>