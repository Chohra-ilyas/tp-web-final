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
        <link rel="stylesheet" href="./styles/Home.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <title>home</title>
    </head>

    <body>
        <form action="find-post.php" method="post">
            <div id="top-container">
                <div class="userInfo">
                    <img src="./images/no-picture.jpg" alt="" id="pfp">
                    <?php echo  "<span>".$getUser['username']."</span>"  ?>
                </div>

                <div class="findByDate">
                    <h3>find post by date :</h3>
                    <h4>date start :</h4>
                    <input type="date" class="postfind" name="post-date1">
                    <h4>date end :</h4>
                    <input type="date" class="postfind2" name="post-date2">
                    <button type="submit">Find</button>
                </div>

                <a href="logout.php">Logout</a>
            </div>
        </form>
        <div id="main-box">
            <div id="leftSide">
                <i class="bi bi-list-ul"></i>
                <h2>Operations Menu</h2>
                    <a href="signup.php">Add a parent</a>
                    <form action="find-parent.php" method="Post">
                        <input type="text" name="parent-find" placeholder="find,modify and delete a parent account :">
                        <button type="submit">find</button>
                    </form>
            </div>
            <div id="center">
                <h2>this is where the school's description goes</h2>
                <form action="backend-includes/post-create.php" method="post">
                    <div id="posts-container">
                        <div id="create-post">
                            <button>post</button>
                            <textarea name="content" id="post-creation" cols="30" rows="10" placeholder="here the teacher writes the post"></textarea>
                        </div>
                    </div>
                </form>
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
                <h3>parents : </h3>
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