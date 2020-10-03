<div class="search">
  <div class='searchbardiv'>
  <form class="searchbar" action="search.php" method="post">
    <input type="text" name="search" value="" placeholder="Search" required class='search_people'>
    <input type="submit" name="submit" value="🔍">
  </form>
</div>
</div>

<?php
echo "<div class='random_users_display'>";
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  include 'sql.php';
  $stmt = $pdo->prepare("SELECT * FROM users WHERE id!=:id ORDER BY RAND() LIMIT 5");
  $stmt->execute(['id'=>$_SESSION['id']]);
  $data = $stmt->fetchAll();
  foreach ($data as $row) {
    echo "<div class='user_random'>";
    echo "<img src='".$row['avatar']."' alt='avatar' class='randomuser_slika'>";
    echo "".$row['name']." <a href=profile.php?id=".$row['id'].">@".$row['username']."</a>";
    echo "</div>";
  }
  echo "</div>";
?>
