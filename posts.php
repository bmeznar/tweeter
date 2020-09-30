<?php
  //session_start();
  include 'sql.php';
  $stmt = $pdo->prepare("SELECT u.name AS name,u.username AS username,u.id AS user_id,p.date AS pdate,p.description AS description, p.id AS id, i.url AS url,COUNT(l.id) AS likes,p.id AS id FROM posts AS p INNER JOIN users AS u ON u.id=p.user_id
INNER JOIN following AS f ON f.follower_id=u.id LEFT JOIN images AS i ON i.post_id=p.id
LEFT JOIN likes AS l ON l.post_id=p.id WHERE f.user_id=:id GROUP BY p.id ORDER BY date DESC");
  $stmt->execute(['id'=>$_SESSION['id']]);
  $data = $stmt->fetchAll();
  foreach ($data as $row) {
    if(isset($row['url'])){
      echo "<div class='posts' style='border:1px solid black'>";
      echo "<h3 class='name'>".$row['name']."</h3>";
      echo "<h4 class='username'><a href='profile.php?id=".$row['user_id']."'>@".$row['username']."</a></h4>";
      echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5>";
      echo "<a href='post_display.php?id=".$row['id']."'>More</a>";
      echo "<p class='description'>".$row['description']."</p>";
      echo "<div class='post_img'><img src='".$row['url']."' alt='image'></div>";
      echo "<p class='bottom_bar'><a href='like.php'>Like</a>".$row['likes']."</p></div>";
    }
    else{
      echo "<div class='posts' style='border:1px solid black'>";
      echo "<h3 class='name'>".$row['name']."</h3>";
      echo "<h4 class='username'><a href='profile.php?id=".$row['user_id']."'>@".$row['username']."</a></h4>";
      echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5>";
      echo "<a href='post_display.php?id=".$row['id']."'>More</a>";
      echo "<p class='description'>".$row['description']."</p>";
      echo "<p class='bottom_bar'><a href='like.php'>Like</a>".$row['likes']."</p></div>";
    }
  }
  $pdo=null;
?>
