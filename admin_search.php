<!DOCTYPE html>
<html lang="sl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birdie Admin</title>
    <link rel="stylesheet" href="css/admin.css">
  </head>
  <body>
    <div class="">
      <h4>Admin panel</h4>
    </div>
    <form class="search" action="admin_search.php" method="post">
      Search users:
      <input type="text" name="search" value="">
      <input type="submit" name="submit" value="🔍">
    </form><br>
    <div class="results">
    <?php
    if(isset($_POST['search'])){
    include 'sql.php';
    $search="%".$_POST['search']."%";
    $result = $pdo->prepare("SELECT * FROM `users` WHERE `name` LIKE ? OR `username` LIKE ?");
    $result->execute(array($search,$search));
    foreach($result as $row) {
     echo "<div class='users'>".$row['name']." @".$row['username']." <a href='proofile_admin.php?id=".$row['id']."'>Show profile</a></div>";
   }}
    ?>
  </div>
  </body>
</html>
