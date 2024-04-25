<?php
include("../include/connections.php");
if (!isset($_POST['add'])) {
  $likes = $post['likes'] + 1;
  mysqli_query($conn, "UPDATE posts SET likes=$likes WHERE user=$_SESSION[username]");
}
header("Location:home-prof.php");


//probably wont use again;