<!DOCTYPE html>
<html lang="sl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/profile_admin.css">
  </head>
  <body>
    <?php
        include 'sql.php';
        echo "<div class='profile'>";
        $id=$_GET['id'];
        $stmt = $pdo->query("SELECT * FROM users WHERE id=$id");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
          echo "<img src='".$row['avatar']."' class='user_main_avatar'><h4>".$row['name']."</h4><br>\n";
          echo "@".$row['username']."<br>";
          echo $row['bio']."<br>";
          $date = strtotime($row['birthday']);
          echo "Birthday: ".date('d/m/Y',$date)."<br>";
          echo "<a href='delete_user_verify.php?id=".$id."'>Delete user</a><br><br>";

        }

        $stmt = $pdo->prepare("SELECT u.name AS name,u.username AS username,p.date AS pdate,p.description AS description, p.id AS pid, i.url AS url,COUNT(l.id) AS likes,
        u.id AS user_id,u.avatar AS avatar FROM posts AS p INNER JOIN users AS u ON u.id=p.user_id LEFT JOIN images AS i ON i.post_id=p.id
        LEFT JOIN likes AS l ON l.post_id=p.id WHERE p.user_id=:id GROUP BY p.id ORDER BY date DESC");
        $stmt->execute(['id'=>$id]);
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
            echo "<a href='post_display.php?id=".$row['pid']."'>More</a>";
            echo "<p class='description'>".$row['description']."</p>";
            echo "<div class='post_img'><img src='".$row['url']."' alt='image'></div>";
            echo "<div class='bottom_bar'>";

            echo "<br><a href='delete_post_verify.php?id=".$post_id."'>Delete Post</a></div><br>";
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

            //include 'sql2.php';

            echo "<br><a href='delete_post_verify.php?id=".$post_id."'>Delete Post</a></div><br>";
            echo "</div>";
          }
        }
        $pdo=null;
        echo "</div>";
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
