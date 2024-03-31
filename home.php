<?php
session_start();
include("./include/connections.php");

if(isset($_SESSION['id']) && isset($_SESSION['username'])){
    $id = $_SESSION['id'];
    $user = $_SESSION['username'];
    $getUser = mysqli_query($conn,"SELECT * FROM users WHERE username ='$user'");
    $getUser = mysqli_fetch_array($getUser);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
</head>
<body>
    <a href="logout.php">logout</a>
    <h4>hello MR.<?php echo "<img src='./images/".$getUser['profile_picture']."'.  alt=''>"?></h4>
</body>
</html>

<?php

}else{
    header('location: login.php');
    exit();
}
?>