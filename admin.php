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
      <?php
      session_start();
      include 'sql.php';
      $stmt = $pdo->prepare("SELECT u.avatar AS avatar, u.name AS name,u.username AS username,p.date AS pdate,p.description AS description, p.id AS pid, i.url AS url,COUNT(l.id) AS likes,
      u.id AS user_id FROM posts AS p INNER JOIN users AS u ON u.id=p.user_id LEFT JOIN images AS i ON i.post_id=p.id
      LEFT JOIN likes AS l ON l.post_id=p.id GROUP BY p.id ORDER BY pdate DESC");
      $stmt->execute([]);
      $data = $stmt->fetchAll();
      $i=0;
      foreach ($data as $row) {
        $post_id=$row['pid'];
        $num_likes=$row['likes'];
        if(isset($row['url'])){
          echo "<div class='posts' style='border:1px solid black'>";
          echo "<a id='post".$i."'></a>";
          echo "<img src='".$row['avatar']."' class='user_avatar'><h3 class='name'>".$row['name']."</h3>";
          echo "<h4 class='username'><a href='profile.php?id=".$row['user_id']."'>@".$row['username']."</a></h4>";
          echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5>";
          echo "<a href='admin_post.php?id=".$row['pid']."'>More</a>";
          echo "<p class='description'>".$row['description']."</p>";
          echo "<div class='post_img'><img src='".$row['url']."' alt='image' class='post_image'></div>";
          echo "<div class='bottom_bar'>";

          echo "<br><a href='delete_post_admin.php?id=".$post_id."'>Delete Post</a></div><br>";
          echo "</div>";
        }

        else{
          echo "<div class='posts' style='border:1px solid black'>";
          echo "<a id='post".$i."'></a>";
          echo "<img src='".$row['avatar']."' class='user_avatar'><h3 class='name'>".$row['name']."</h3>";
          echo "<h4 class='username'><a href='profile.php?id=".$row['user_id']."'>@".$row['username']."</a></h4>";
          echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5>";
          echo "<a href='post_display.php?id=".$row['pid']."'>More</a>";
          echo "<p class='description'>".$row['description']."</p>";
          echo "<div class='bottom_bar'>";
          echo "<br><a href='delete_post_admin.php?id=".$post_id."'>Delete Post</a></div><br>";
          echo "</div>";}
        }
      $pdo=null;
      echo "</div>";
      ?>
  </body>
</html>
