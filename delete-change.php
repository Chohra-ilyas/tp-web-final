<?php
include("./include/connections.php");
session_start();

if (!isset($_POST['delete']) && !isset($_POST['change'])) {
  header('location: home-prof.php');
} elseif (isset($_POST['delete'])) {
  $theparent = $_SESSION['theparent'];
  $query = "DELETE FROM `users` WHERE username='$theparent'";
  mysqli_query($conn, $query);
  header('location: home-prof.php');
} elseif (isset($_POST['change'])) {
  $theparent = $_SESSION['theparent'];
  include("update.php");
}
