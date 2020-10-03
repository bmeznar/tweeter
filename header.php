<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$_SESSION['avatar'];
echo "<div class='loged_user'><img src='".$_SESSION['avatar']."' alt='profile picture' class='avatar'>";
echo " Hello, ".$_SESSION['name']."</div>"; ?>
<div class='navigacija'>
<a href="index.php" class="link"><img src="uploads/home_button_index.png" alt="home" class="link"></a><br>
<a href="search.php" class="link"><img src="uploads/search_button_index.png" alt="search" class="link"></a><br>
<a href="pinned.php" class="link"><img src="uploads/pin_button_index.png" alt="pin" class="link"></a><br>
<a href="myprofile.php" class="link"><img src="uploads/profile_button_index.png" alt="myprofile" class="link"></a><br>
<a href="logout.php" class="link"><img src="uploads/logout_button_index.png" alt="logout" class="link"></a><br>
<?php include 'addpost.php'; ?>
</div>
