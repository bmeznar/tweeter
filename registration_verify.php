<?php
include_once 'sql.php';

$name = $_POST['name'];
$email = $_POST['email'];
$birthday = $_POST['birth'];
$username = $_POST['username'];
$pass1 = $_POST['password1'];
$pass2 = $_POST['password2'];
//preverim podatke, da so obvezi vnešeni
if (!empty($name) && !empty($email)
        && !empty($birthday) && !empty($username)
        && !empty($pass1)
        && ($pass1 == $pass2)) {

    $pass = password_hash($pass1, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username,name,email,birthday,"
            . "password) "
            . "VALUES (?,?,?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$username,$name,$email,$birthday,$pass]);

    header("Location: index.php");
}
else {
    header("Location: registration.php");
}
?>
