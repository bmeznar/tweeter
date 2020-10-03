<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$_SESSION['avatar'];
echo "<div class='loged_user'><img src='".$_SESSION['avatar']."' alt='profile picture' class='avatar'>";
echo " Hello, ".$_SESSION['name']."</div>"; ?>
<div class='navigacija'>
<a href="index.php" class="link">Home</a>
<a href="search.php" class="link">Search</a>
<a href="pinned.php" class="link">Pinned</a>
<a href="myprofile.php" class="link">Profile</a>
<a href="logout.php" class="link">Log Out</a>
</div>
