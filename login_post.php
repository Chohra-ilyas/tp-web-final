<?php
session_start(); //hereeeeeeeeeeeeeeeeeeeeeeeee
include("./include/connections.php");
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = stripcslashes(strtolower(trim($_POST["username"])));
    $md5_password = md5($_POST['password']);
    $username = filter_input(INPUT_POST, 'username');
    // $password = stripcslashes(strtolower(trim($_POST['password'])));
    $username = htmlentities(mysqli_real_escape_string($conn, $_POST['username']));
    $password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));

    if (isset($_POST['keepLogin'])) {
        $keepLogin = htmlentities(mysqli_real_escape_string($conn, $_POST['keepLogin']));
        if ($keepLogin == 1) {
            setcookie('username', $username, time() + 3600, '/');
            setcookie('password', $password, time() + 3600, '/');
        }
    }

    if (empty($username)) {
        $user_err = 'please enter username';
        $err_s = 1;
    } elseif (strlen(trim($username)) < 5) {
        $user_err = 'username needs to have in min 6 caractere';
        $err_s = 1;
    } elseif (filter_var($username, FILTER_VALIDATE_INT)) {
        $user_err = 'please enter valid username not number';
        $err_s = 1;
    }
    if (empty($password)) {
        $password_err = 'please enter password';
        $err_s = 1;
    } elseif (strlen(trim($password)) < 8) {
        $password_err = 'password must be 8 caracters in min';
        $err_s = 1;
    }

    if (isset($err_s)) { //heeeerrrrrrrrrrrrrrreeeeeeeeeeeeeeeeeeeeeeeee
        include('login.php');
    }
}
if (!isset($err_s)) {
    $sql = "SELECT * FROM users WHERE username = '$username' AND md5_pass = '$md5_password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        $notExist = "username or password wrong";
        include('login.php'); //hereeeeeeeeeeeeeeeeeeeeeeeeeeee new
    } elseif ($row['username'] === $username && $row['password'] === $password  && $row['job'] === 'Prof') { //hereeeeee   && $row['job'] === 'prof'
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['job'] = $row['job'];
        header('location:home-prof.php');
        exit();
    } elseif ($row['username'] === $username && $row['password'] === $password  && $row['job'] === 'Student') {
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['job'] = $row['job'];
        header('location:home-parent.php');
    } else {
        $user_err = 'Wrong username or Password';
        exit();
    }
}
