<!DOCTYPE html>
<html lang="sl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  </head>
  <body>
    <?php
        include 'header.php';
        include 'sql.php';
        echo "<div class='profile'>";
        //session_start();
        $id=$_SESSION['id'];
        $stmt = $pdo->query("SELECT * FROM users WHERE id=$id");
        $stmt->execute();
        while ($row = $stmt->fetch()) {
          echo "<h4>".$row['name']."</h4><br>\n";
          echo "@".$row['username']."<br>";
          echo $row['bio']."<br>";
          $date = strtotime($row['birthday']);
          echo "Birthday: ".date('d/m/Y',$date)."<br>";
          echo "<a href='profile_settings.php'>Profile Settings</a>";
        }
        $stmt = $pdo->prepare("SELECT u.name AS name,u.username AS username,p.date AS pdate,p.description AS description, p.id AS pid, i.url AS url,COUNT(l.id) AS likes,
        u.id AS user_id FROM posts AS p INNER JOIN users AS u ON u.id=p.user_id LEFT JOIN images AS i ON i.post_id=p.id
        LEFT JOIN likes AS l ON l.post_id=p.id WHERE p.user_id=:id GROUP BY p.id ORDER BY date DESC");
        $stmt->execute(['id'=>$_SESSION['id']]);
        $data = $stmt->fetchAll();
        $i=0;
        foreach ($data as $row) {
          $post_id=$row['pid'];
          $num_likes=$row['likes'];
          if(isset($row['url'])){
            echo "<div class='posts' style='border:1px solid black'>";
            echo "<a id='post".$i."'></a>";
            echo "<h3 class='name'>".$row['name']."</h3>";
            echo "<h4 class='username'><a href='profile.php?id=".$row['user_id']."'>@".$row['username']."</a></h4>";
            echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5>";
            echo "<a href='post_display.php?id=".$row['pid']."'>More</a>".$row['pid'];
            echo "<p class='description'>".$row['description']."</p>";
            echo "<div class='post_img'><img src='".$row['url']."' alt='image'></div>";
            echo "<div class='bottom_bar'>";
            //like button
            include 'sql2.php';
            $stmt = $pdo2->prepare("SELECT * FROM likes WHERE user_id=:user_id AND post_id=:post_id");
            $stmt->execute(['user_id'=>$_SESSION['id'],'post_id'=>$post_id]);
            $data = $stmt->fetchAll();
            $user_like=0;
            foreach ($data as $row) {
              $user_like++;
            }
            if($user_like>0){
              echo "<form method='post'><input type='hidden' value=".$post_id." name='id'>";
              echo "<input type='hidden' value=".$i." name='post'>";
              echo "<br><button type='submit' formaction='unlike_verify.php'>Liked</button>".$num_likes."</form>";
            }
            else{
              echo "<form method='post'><input type='hidden' value=".$post_id." name='id'>";
              echo "<input type='hidden' value=".$i." name='post'>";
              echo "<br><button type='submit' formaction='like_verify.php'>Like</button>".$num_likes."</form>";
            }
            //comment button
            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal-".$i."'>Comments</button>";
            //comment modal

            echo "<div class='modal' id='myModal-".$i."'>";
            echo "<div class='modal-dialog'>";
            echo "<div class='modal-content'>";
            echo "<div class='modal-header'>";
            echo "<h4 class='modal-title'>Add Comment</h4>";
            echo "<button type='button' class='close' data-dismiss='modal'>×</button></div>";
            echo "<div class='modal-body'>";
            echo "<form action='addcomment_verify.php?post_id=".$post_id."' method='post'>";
            echo "<input type='text' name='comment' placeholder='Your comment' required><br>";
            echo "<input type='hidden' value=".$i." name='post'>";
            echo "<input type='submit' name='submit' value='Add Comment'></form>";
            echo "</div>";
            echo "<div class='modal-footer'>";
            echo "<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>";
            echo "</div></div></div></div>";
            //retweet
            //include 'sql2.php';
            $stmt = $pdo2->prepare("SELECT * FROM retweet WHERE user_id=:user_id AND post_id=:post_id");
            $stmt->execute(['user_id'=>$_SESSION['id'],'post_id'=>$post_id]);
            $data = $stmt->fetchAll();
            $retweet=0;
            foreach ($data as $row) {
              $retweet++;
            }
              if($retweet>0){
              echo "<form method='post'><input type='hidden' value=".$post_id." name='id'>";
              echo "<input type='hidden' value=".$i." name='post'>";
              echo "<br><button type='submit' formaction='undo_retweet_verify.php'>Undo Retweet</button></form>";
            }
            else{
              echo "<form method='post'><input type='hidden' value=".$post_id." name='id'>";
              echo "<input type='hidden' value=".$i." name='post'>";
              echo "<br><button type='submit' formaction='retweet_verify.php'>Retweet</button></form>";
            }
            //pin

            echo "<br><a href='delete_post_verify.php?id=".$post_id."'>Delete Post</a></div><br>";
            echo "</div></div>";
          }

          else{
            echo "<div class='posts' style='border:1px solid black'>";
            echo "<a id='post".$i."'></a>";
            echo "<h3 class='name'>".$row['name']."</h3>";
            echo "<h4 class='username'><a href='profile.php?id=".$row['user_id']."'>@".$row['username']."</a></h4>";
            echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5>";
            echo "<a href='post_display.php?id=".$row['pid']."'>More</a>";
            echo "<p class='description'>".$row['description']."</p>";
            echo "<div class='bottom_bar'>";
            //like button
            include 'sql2.php';
            $stmt = $pdo2->prepare("SELECT * FROM likes WHERE user_id=:user_id AND post_id=:post_id");
            $stmt->execute(['user_id'=>$_SESSION['id'],'post_id'=>$post_id]);
            $data = $stmt->fetchAll();
            $user_like=0;
            foreach ($data as $row) {
              $user_like++;
            }
            if($user_like>0){
              echo "<form method='post'><input type='hidden' value=".$post_id." name='id'>";
              echo "<input type='hidden' value=".$i." name='post'>";
              echo "<br><button type='submit' formaction='unlike_verify.php'>Liked</button>".$num_likes."</form>";
            }
            else{
              echo "<form method='post'><input type='hidden' value=".$post_id." name='id'>";
              echo "<input type='hidden' value=".$i." name='post'>";
              echo "<br><button type='submit' formaction='like_verify.php'>Like</button>".$num_likes."</form>";
            }
            //comment button
            echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#myModal-".$i."'>Comments</button>";
            //comment modal

            echo "<div class='modal' id='myModal-".$i."'>";
            echo "<div class='modal-dialog'>";
            echo "<div class='modal-content'>";
            echo "<div class='modal-header'>";
            echo "<h4 class='modal-title'>Add Comment</h4>";
            echo "<button type='button' class='close' data-dismiss='modal'>×</button></div>";
            echo "<div class='modal-body'>";
            echo "<form action='addcomment_verify.php?post_id=".$post_id."' method='post'>";
            echo "<input type='text' name='comment' placeholder='Your comment' required><br>";
            echo "<input type='hidden' value=".$i." name='post'>";
            echo "<input type='submit' name='submit' value='Add Comment'></form>";
            echo "</div>";
            echo "<div class='modal-footer'>";
            echo "<button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>";
            echo "</div></div></div></div>";
            //retweet
            //include 'sql2.php';
            $stmt = $pdo2->prepare("SELECT * FROM retweet WHERE user_id=:user_id AND post_id=:post_id");
            $stmt->execute(['user_id'=>$_SESSION['id'],'post_id'=>$post_id]);
            $data = $stmt->fetchAll();
            $retweet=0;
            foreach ($data as $row) {
              $retweet++;
            }
              if($retweet>0){
              echo "<form method='post'><input type='hidden' value=".$post_id." name='id'>";
              echo "<input type='hidden' value=".$i." name='post'>";
              echo "<br><button type='submit' formaction='undo_retweet_verify.php'>Undo Retweet</button></form>";
            }
            else{
              echo "<form method='post'><input type='hidden' value=".$post_id." name='id'>";
              echo "<input type='hidden' value=".$i." name='post'>";
              echo "<br><button type='submit' formaction='retweet_verify.php'>Retweet</button></form>";
            }
            //pin

            echo "<br><a href='delete_post_verify.php?id=".$post_id."'>Delete Post</a></div><br>";
            echo "</div></div>";
          }
          /*if(isset($row['url'])){
            echo "<div class='posts' style='border:1px solid black'>";
            echo "<h3 class='name'>".$row['name']."</h3>";
            echo "<h5 class='username'>@".$row['username']."</h4>";
            echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5><br>";
            echo "<p class='description'>".$row['description']."</p>";
            echo "<div class='post_img'><img src='".$row['url']."' alt='image'></div>";
            //LIKE
            echo "<div class='bottom_bar'><a href='like.php'>Like</a>".$row['likes'];
            echo "<br><a href='delete_post_verify.php?id=".$row['pid']."'>Delete Post</a></div><br>";
            echo "</div></div><br>";
          }
          else{
            echo "<div class='posts' style='border:1px solid black'>";
            echo "<h3 class='name'>".$row['name']."</h3>";
            echo "<h5 class='username'>@".$row['username']."</h4>";
            echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5><br>";
            echo "<p class='description'>".$row['description']."</p>";
            //LIKE
            echo "<div class='bottom_bar'><a href='like.php'>Like</a>".$row['likes'];
            echo "<br><a href='delete_post_verify.php?id=".$row['pid']."'>Delete Post</a></div><br>";
            echo "</div></div><br>";
          }*/
        }
        $pdo=null;
        echo "</div>";
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
