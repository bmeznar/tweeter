<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
$_SESSION['avatar'];
echo "<img src='".$_SESSION['avatar']."' alt='profile picture'>";
echo "Hello ".$_SESSION['name']; ?>

<a href="index.php">Home</a>
<a href="search.php">Search</a>
<a href="messages.php">Messages</a>
<a href="pinned.php">Pinned</a>
<a href="myprofile.php">Profile</a>
<a href="logout.php">Log Out</a>
