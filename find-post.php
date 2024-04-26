<?php
session_start();
include("./include/connections.php");
if (empty($_POST['post-date1']) || empty($_POST['post-date2']) && $_SESSION['job'] == 'Prof') {
  header("Location:home-prof.php");
} elseif (empty($_POST['post-date1']) || empty($_POST['post-date2']) && $_SESSION['job'] == 'Student') {
  header("Location:home-parent.php");
} else {
  $date1 = $_POST['post-date1'];
  $date2 = $_POST['post-date2'];
  $sql = "SELECT * FROM posts WHERE `date`>'$date1' and `date`<'$date2'  ";
  $res = mysqli_query($conn, $sql);
  $row_count = mysqli_num_rows($res);



  if ($row_count > 0) {
    while ($post = mysqli_fetch_assoc($res)) {
      include("single-post.php");
    }
  } else {
    if ($_SESSION['job'] == 'Student') {
      header("Location:home-parent.php");
    } elseif ($_SESSION['job'] == 'Prof') {
      header("Location:home-prof.php");
    }
  }
}
