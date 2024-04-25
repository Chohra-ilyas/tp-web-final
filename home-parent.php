<?php
session_start();
include("./include/connections.php");

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
  $id = $_SESSION['id'];
  $user = $_SESSION['username'];
  $getUser = mysqli_query($conn, "SELECT * FROM users WHERE id =$id");
  $getUser = mysqli_fetch_array($getUser);

  if (isset($_POST['parent-find']) && $result) {
    $_SESSION['parent-find'] = $_POST['parent-find'];
  }



?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/home.css">
    <title>home</title>
  </head>

  <body>
    <form method="post">
      <div id="top-container">
        <div>
          <img src="./images/no-picture.jpg" alt="" id="pfp">
          <?php echo  $getUser['username']  ?>
        </div>
        <input type="text" id="post-search" placeholder="search for a post">

        <a href="logout.php">logout</a>
      </div>
    </form>
    <div id="main-box">
      <div id="center">
        <div>this is where the school's description goes</div>
        <div id="post-bar">
          <?php
          $getPost = mysqli_query($conn, "SELECT * FROM posts");
          $row_count = mysqli_num_rows($getPost);
          if ($row_count > 0) {
            while ($post = mysqli_fetch_assoc($getPost)) {
              include("single-post.php");
            }
          }

          ?>
        </div>
      </div>
      <div id="parents-container">
        <?php
        $getTeacher = mysqli_query($conn, "SELECT * FROM `users` WHERE job='Student'");
        $teacher_row_count = mysqli_num_rows($getTeacher);

        if ($teacher_row_count > 0) {
          while ($teacher = mysqli_fetch_assoc($getTeacher)) {
            include("single-teacher.php");
          }
        }

        ?></div>
    </div>
  </body>

  </html>

<?php

} else {
  header('location: login.php');
  exit();
}
?>