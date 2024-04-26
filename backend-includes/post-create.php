<?php
include("../include/connections.php");
session_start();
echo "yessir it should work";
$content = addslashes($_POST['content']);
if (empty($content)) {
  header("Location:../home-prof.php");
} else {
  $user = $_SESSION['username'];
  $currentDate = date('Y-m-d');
  echo $currentDate;
  $likes = 0;



  $sql = "INSERT INTO `posts`(`user`, `date`, `content`, `likes`) VALUES ('$user','$currentDate','$content',$likes)";
  mysqli_query($conn, $sql);
}
header("Location:../home-prof.php");
