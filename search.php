 <!DOCTYPE html>
 <html lang="sl" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Birdie</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" href="css/search.css">
   </head>
   <body>
     <?php include 'header.php'; ?>
     <div class="all_search">
       <div class="search_users">
         <form class="searchbar" action="search.php" method="post">
           <input type="text" name="search" value="" placeholder="search" class="users_search" required>
           <input type="submit" name="submit" value="🔍">
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
     </div>
     <?php include 'random_people.php'; ?>

     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   </body>
 </html>
