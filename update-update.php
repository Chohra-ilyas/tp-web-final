<?php
session_start();
include("./include/connections.php");

if (isset($_POST["submit"])) {
  $username = stripcslashes(strtolower(trim($_POST["username"])));
  $email = stripcslashes(strtolower(trim($_POST['email'])));
  $password = stripcslashes(strtolower(trim($_POST['password'])));
  if (isset($_POST['birthday_month']) && isset($_POST['birthday_day']) && isset($_POST['birthday_year'])) {
    $birthday_month = (int)$_POST['birthday_month'];
    $birthday_day = (int)$_POST['birthday_day'];
    $birthday_year = (int)$_POST['birthday_year'];
    $birthday = htmlentities(mysqli_real_escape_string($conn, $birthday_day . '-' . $birthday_month . '-' . $birthday_year));
  }

  $username = htmlentities(mysqli_real_escape_string($conn, $_POST['username']));
  $email = htmlentities(mysqli_real_escape_string($conn, $_POST['email']));
  $password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));
  $md5_password = md5($password);

  if (isset($_POST['gender'])) {
    $gender = $_POST['gender'];
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    if (!in_array($gender, ['male', 'famale'])) {
      $gender_error = 'please choose gender not text!!!';
      $err_s = 1;
    }
  }

  $err_s = 0;
  $check_user = "SELECT * FROM users WHERE username = '$username'";
  $check_result = mysqli_query($conn, $check_user);
  $num_rows = mysqli_num_rows($check_result);

  $theparent = $_SESSION['theparent'];
  $result = mysqli_query($conn, "SELECT * FROM users WHERE username ='$theparent' and job='Student' limit 1");
  $parent = mysqli_fetch_assoc($result);

  if (empty($username)) {
    $user_err = 'please enter username';
    $err_s = 1;
  } elseif (strlen(trim($username)) < 5) {
    $user_err = 'username needs to have in min 6 caractere';
    $err_s = 1;
  } elseif (filter_var($username, FILTER_VALIDATE_INT)) {
    $user_err = 'please enter valid usernamenot number';
    $err_s = 1;
  }

  if (empty($email)) {
    $email_err = 'please enter email';
    $err_s = 1;
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $email_err = 'please enter valid email';
    $err_s = 1;
  }

  if (empty($gender)) {
    $gender_err = 'enter choose gender';
    $err_s = 1;
  }


  if (empty($birthday)) {
    $birthday_err = 'please insert you birthday';
    $err_s = 1;
    header('location:signup.php'); //hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
  }

  if (empty($password)) {
    $password_err = 'please enter password';
    $err_s = 1;
  } elseif (strlen(trim($password)) < 8) {
    $password_err = 'password must be 8 caracters in min';
    $err_s = 1;
  }

  $old_user = $parent['username'];
  $sql = "UPDATE users SET `username`='$username',`password`='$password',`email`='$email' WHERE `username` = '$old_user' ;";
  mysqli_query($conn, $sql); //  hereeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee
  header("location:home-prof.php");
}
