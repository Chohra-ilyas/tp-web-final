<?php
session_start();
include("./include/connections.php");
if (!empty($_POST['parent-find'])) {
  $check_name = $_POST['parent-find'];

  $result = mysqli_query($conn, "SELECT * FROM users WHERE username ='$check_name' and job='Student' limit 1");
  if (!$result) {
    header("Location:home-prof.php");
  } else {
    if (mysqli_num_rows($result) > 0) {
      while ($parent = mysqli_fetch_assoc($result)) {
        include("single-parent.php");
      }
    }
  }
} else {
  header('location: home-prof.php');
}
