<!DOCTYPE html>
<html lang="sl" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Birdie</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="css/post.css">
  </head>
  <body>
    <?php
    include 'header.php';
    include 'sql.php';
    $post_id=$_GET['id'];
    $stmt = $pdo->prepare("SELECT u.name AS name,u.avatar AS avatar, u.username AS username,u.id AS user_id, p.date AS pdate, p.description AS description, i.url AS url, COUNT(l.id) AS likes, p.id AS id FROM posts AS p INNER JOIN users AS u
    ON u.id=p.user_id
    LEFT JOIN images AS i ON i.post_id=p.id LEFT JOIN likes AS l ON l.post_id=p.id WHERE p.id=:id");
    $stmt->execute(['id'=>$post_id]);
    $data = $stmt->fetchAll();
    $i=1;
    foreach ($data as $row){
    $user_id=$row['user_id'];
      $likes=$row['likes'];
      if(isset($row['url'])){
        echo "<div class='posts' style='border:1px solid black'>";
        echo "<img src='".$row['avatar']."' class='user_main'><h3 class='name'>".$row['name']."</h3>";
        echo "<h4 class='username'><a href='profile.php?id=".$row['user_id']."'>@".$row['username']."</a></h4>";
        echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5>";
        echo "<p class='description'>".$row['description']."</p>";
        echo "<div class='post_img'><img src='".$row['url']."' alt='image'></div>";
        echo "<div class='bottom_bar'>";
        include 'sql2.php';
        $stmt = $pdo2->prepare("SELECT * FROM likes WHERE user_id=:user_id AND post_id=:post_id");
        $stmt->execute(['user_id'=>$_SESSION['id'],'post_id'=>$post_id]);
        $data = $stmt->fetchAll();
        $user_like=0;
        foreach ($data as $row) {
          $user_like++;
        }
        if($user_like>0){
          echo "<form method='post' class='form_bottom'><input type='hidden' value=".$post_id." name='id'>";
          echo "<input type='hidden' value=".$i." name='post'>";
          echo "<br><button type='submit' formaction='unlike_verify.php'>Liked</button>".$likes."</form>";
        }
        else{
          echo "<form method='post' class='form_bottom'><input type='hidden' value=".$post_id." name='id'>";
          echo "<input type='hidden' value=".$i." name='post'>";
          echo "<br><button type='submit' formaction='like_verify.php'>Like</button>".$likes."</form>";
        }
        //retweet
        include 'sql2.php';
        $stmt = $pdo2->prepare("SELECT * FROM retweet WHERE user_id=:user_id AND post_id=:post_id");
        $stmt->execute(['user_id'=>$_SESSION['id'],'post_id'=>$post_id]);
        $data = $stmt->fetchAll();
        $retweet=0;
        foreach ($data as $row) {
          $retweet++;
        }
          if($retweet>0){
          echo "<form method='post' class='form_bottom'><input type='hidden' value=".$post_id." name='id'>";
          echo "<input type='hidden' value=".$i." name='post'>";
          echo "<br><button type='submit' formaction='undo_retweet_verify.php'>Undo Retweet</button></form>";
        }
        else{
          echo "<form method='post' class='form_bottom'><input type='hidden' value=".$post_id." name='id'>";
          echo "<input type='hidden' value=".$i." name='post'>";
          echo "<br><button type='submit' formaction='retweet_verify.php'>Retweet</button></form>";
        }
        //pin
        $stmt = $pdo2->prepare("SELECT * FROM pinned WHERE user_id=:user_id AND post_id=:post_id");
        $stmt->execute(['user_id'=>$_SESSION['id'],'post_id'=>$post_id]);
        $data = $stmt->fetchAll();
        $pin=0;
        foreach ($data as $row) {
          $pin++;
        }
          if($pin>0){
          echo "<form method='post' class='form_bottom'><input type='hidden' value=".$post_id." name='id'>";
          echo "<input type='hidden' value=".$i." name='post'>";
          echo "<br><button type='submit' formaction='unpin_verify.php'>Unpin Post</button></form>";
        }
        else{
          echo "<form method='post' class='form_bottom'><input type='hidden' value=".$post_id." name='id'>";
          echo "<input type='hidden' value=".$i." name='post'>";
          echo "<br><button type='submit' formaction='pin_verify.php'>Pin Post</button></form>";
        }
        echo "</div></div>";
      }
      else{
        echo "<div class='posts' style='border:1px solid black'>";
        echo "<h3 class='name'>".$row['name']."</h3>";
        echo "<h4 class='username'><a href='profile.php?id=".$row['user_id']."'>@".$row['username']."</a></h4>";
        echo "<h5 class='date'>".date('d-m-Y H:i',strtotime($row['pdate']))."</h5>";
        echo "<p class='description'>".$row['description']."</p>";
        echo "<div class='bottom_bar'>";
        include 'sql2.php';
        $stmt = $pdo2->prepare("SELECT * FROM likes WHERE user_id=:user_id AND post_id=:post_id");
        $stmt->execute(['user_id'=>$_SESSION['id'],'post_id'=>$post_id]);
        $data = $stmt->fetchAll();
        $user_like=0;
        foreach ($data as $row) {
          $user_like++;
        }
        if($user_like>0){
          echo "<form method='post' class='form_bottom'><input type='hidden' value=".$post_id." name='id'>";
          echo "<input type='hidden' value=".$i." name='post'>";
          echo "<br><button type='submit' formaction='unlike_verify.php'>Liked</button>".$likes."</form>";
        }
        else{
          echo "<form method='post' class='form_bottom'><input type='hidden' value=".$post_id." name='id'>";
          echo "<input type='hidden' value=".$i." name='post'>";
          echo "<br><button type='submit' formaction='like_verify.php'>Like</button>".$likes."</form>";
        }

        //retweet
        include 'sql2.php';
        $stmt = $pdo2->prepare("SELECT * FROM retweet WHERE user_id=:user_id AND post_id=:post_id");
        $stmt->execute(['user_id'=>$_SESSION['id'],'post_id'=>$post_id]);
        $data = $stmt->fetchAll();
        $retweet=0;
        foreach ($data as $row) {
          $retweet++;
        }
          if($retweet>0){
          echo "<form method='post' class='form_bottom'><input type='hidden' value=".$post_id." name='id'>";
          echo "<input type='hidden' value=".$i." name='post'>";
          echo "<br><button type='submit' formaction='undo_retweet_verify.php'>Undo Retweet</button></form>";
        }
        else{
          echo "<form method='post' class='form_bottom'><input type='hidden' value=".$post_id." name='id'>";
          echo "<input type='hidden' value=".$i." name='post'>";
          echo "<br><button type='submit' formaction='retweet_verify.php'>Retweet</button></form>";
        }
        //pin
        $stmt = $pdo2->prepare("SELECT * FROM pinned WHERE user_id=:user_id AND post_id=:post_id");
        $stmt->execute(['user_id'=>$_SESSION['id'],'post_id'=>$post_id]);
        $data = $stmt->fetchAll();
        $pin=0;
        foreach ($data as $row) {
          $pin++;
        }
          if($pin>0){
          echo "<form method='post' class='form_bottom'><input type='hidden' value=".$post_id." name='id'>";
          echo "<input type='hidden' value=".$i." name='post'>";
          echo "<br><button type='submit' formaction='unpin_verify.php'>Unpin Post</button></form>";
        }
        else{
          echo "<form method='post' class='form_bottom'><input type='hidden' value=".$post_id." name='id'>";
          echo "<input type='hidden' value=".$i." name='post'>";
          echo "<br><button type='submit' formaction='pin_verify.php'>Pin Post</button></form>";
        }
        echo "</div></div>";
      }
    }
    echo "<form class='' action='addcomment_verify.php?post_id=".$post_id."' method='post'>
      <input type='text' name='comment' value='' required placeholder='Your Comment'><br>
      <input type='submit' name='submit' value='Add Comment'>
    </form>";
    echo "<div class='all_comments'>";
    $stmt = $pdo->prepare("SELECT c.text AS text, u.username AS username,u.name AS name, u.id AS id FROM comments AS c INNER JOIN users AS u ON u.id=c.user_id  WHERE c.post_id=:id");
    $stmt->execute(['id'=>$post_id]);
    $data = $stmt->fetchAll();
    foreach ($data as $row){
        echo "<div class='comment'>";
        echo "<p>".$row['name']." <a href='profile.php?id=".$user_id."'>@".$row['username']."</a></p>";
        echo $row['text']."</div>";
    }
    echo "</div>";
    ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
