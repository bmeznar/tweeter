<?php
require_once 'vendor/autoload.php';

// init configuration
$clientID = '964524459871-7i0d5rgdp2vbs38mod2vgtiuhn3vr2ca.apps.googleusercontent.com';
$clientSecret = 'T8sVBAGkNrjP5vg8Vr6t553b';
$redirectUri = 'http://birdie.dropbargang.com/google_redirect.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
  $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
  $client->setAccessToken($token['access_token']);

  // get profile info
  $google_oauth = new Google_Service_Oauth2($client);
  $google_account_info = $google_oauth->userinfo->get();
  $email =  $google_account_info->email;
  $name =  $google_account_info->name;
  $fullUser = $email;
  $username = substr($fullUser, 0, strpos($fullUser, '@'));
  include 'sql.php';
  session_start();
  $stmt = $pdo->prepare("SELECT * FROM users WHERE email=:email");
  $stmt->execute(['email' => $email]);
  $data = $stmt->fetchAll();
  $st=0;
  foreach ($data as $row) {
      $_SESSION['username']=$row['username'];
      $_SESSION['email']=$row['email'];
      $_SESSION['avatar']=$row['avatar'];
      $_SESSION['name']=$row['name'];
      $_SESSION['id']=$row['id'];
      $st++;
  }
  if($st==0){
      include 'sql.php';
      $sql = "INSERT INTO users (name,username,email) VALUES (?,?,?)";
      $pdo->prepare($sql)->execute([$name, $username, $email]);
      $lastId = $pdo->lastInsertId();
      $query = "INSERT INTO following (user_id,follower_id) VALUES (?,?)";
      $stmt = $pdo->prepare($query);
      $stmt->execute([$lastId,$lastId]);
      $_SESSION['username']=$username;
      $_SESSION['email']=$email;
      $_SESSION['avatar']="uploads/default_profile.png";
      $_SESSION['name']=$name;
      $_SESSION['id']=$lastId;
      header('Location:index.php');
  }
  else{
      header('Location:index.php');
  }

  // now you can use this profile info to create account in your website and make user logged in.
} else {
  echo "<a href='".$client->createAuthUrl()."'>Google Login</a>";
}
?>
