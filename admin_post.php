<!DOCTYPE html>
<html lang="sl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birdie</title>
    <link rel="stylesheet" href="css/post.css">
  </head>
  <body>
    <?php
    include 'sql.php';
    $post_id=$_GET['id'];
    $stmt = $pdo->prepare("SELECT u.name AS name,u.avatar AS avatar, u.username AS username,u.id AS user_id, p.date AS pdate, p.description AS description, i.url AS url, COUNT(l.id) AS likes, p.id AS id FROM posts AS p
    INNER JOIN users AS u ON u.id=p.user_id
    LEFT JOIN images AS i ON i.post_id=p.id LEFT JOIN likes AS l ON l.post_id=p.id WHERE p.id=:id");
    $stmt->execute(['id'=>$post_id]);
    $data = $stmt->fetchAll();
    foreach ($data as $row){
      if(isset($row['url'])){
        echo "<div class='posts' style='border:1px solid black'>";
        echo "<img src='".$row['avatar']."' class='user_main'><h3 class='name'>".$row['name']."</h3>";
        echo "<h4 class='username'><a href='profile.php?id=".$row['user_id']."'>@".$row['username']."</a></h4>";
        echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5>";
        echo "<p class='description'>".$row['description']."</p>";
        echo "<div class='post_img'><img src='".$row['url']."' alt='image'></div>";
      }
      else{
        echo "<div class='posts' style='border:1px solid black'>";
        echo "<h3 class='name'>".$row['name']."</h3>";
        echo "<h4 class='username'><a href='profile.php?id=".$row['user_id']."'>@".$row['username']."</a></h4>";
        echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5>";
        echo "<p class='description'>".$row['description']."</p>";

      }
    }
    $stmt = $pdo->prepare("SELECT c.text AS text,c.id AS comment_id, u.username AS username,u.name AS name, u.id AS id FROM comments AS c INNER JOIN users AS u ON u.id=c.user_id  WHERE c.post_id=:id");
    $stmt->execute(['id'=>$post_id]);
    $data = $stmt->fetchAll();
    echo "<div class='all_comments'>";
    foreach ($data as $row){
        echo "<div class='comment'>";
        echo "<p>".$row['name']." <a href='profile.php?id=".$row['id']."'>@".$row['username']."</a></p>";
        echo $row['text']."<br><a href='delete_comment.php?id=".$row['comment_id']."'>Delete comment</a></div>";
    }
    echo "</div>";
    ?>
  </body>
</html>
