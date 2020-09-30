<!DOCTYPE html>
<html lang="sl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Birdie</title>
  </head>
  <body>
    <?php
    include 'header.php';
    include'sql.php';
    $post_id=$_GET['id'];
    $stmt = $pdo->prepare("SELECT u.name AS name, u.username AS username,u.id AS user_id, p.date AS pdate, p.description AS description, i.url AS url, COUNT(l.id) AS likes FROM posts AS p INNER JOIN users AS u ON u.id=p.user_id
    LEFT JOIN images AS i ON i.post_id=p.id LEFT JOIN likes AS l ON l.post_id=p.id WHERE p.id=:id");
    $stmt->execute(['id'=>$post_id]);
    $data = $stmt->fetchAll();
    foreach ($data as $row){
      if(isset($row['url'])){
        echo "<div class='posts' style='border:1px solid black'>";
        echo "<h3 class='name'>".$row['name']."</h3>";
        echo "<h4 class='username'><a href='profile.php?id=".$row['user_id']."'>@".$row['username']."</a></h4>";
        echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5>";
        echo "<p class='description'>".$row['description']."</p>";
        echo "<div class='post_img'><img src='".$row['url']."' alt='image'></div>";
        echo "<p class='bottom_bar'><a href='like.php'>Like</a>".$row['likes']."</p></div>";
      }
      else{
        echo "<div class='posts' style='border:1px solid black'>";
        echo "<h3 class='name'>".$row['name']."</h3>";
        echo "<h4 class='username'><a href='profile.php?id=".$row['user_id']."'>@".$row['username']."</a></h4>";
        echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5>";
        echo "<p class='description'>".$row['description']."</p>";
        echo "<p class='bottom_bar'><a href='like.php'>Like</a>".$row['likes']."</p></div>";
      }
    }?>
    <form class="" action="addcomment_verify.php" method="post">
      <input type="text" name="comment" value=""><br>
      <input type="submit" name="submit" value="Add Comment">
    </form>
    <?php
    $stmt = $pdo->prepare("SELECT c.text AS text, u.username AS username,u.name AS name FROM comments AS c INNER JOIN users AS u ON u.id=c.user_id  WHERE c.post_id=:id");
    $stmt->execute(['id'=>$post_id]);
    $data = $stmt->fetchAll();
    foreach ($data as $row){

    }
    ?>
  </body>
</html>
