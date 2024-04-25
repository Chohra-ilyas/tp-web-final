<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./styles/Login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="login_post.php" method="post">
        <h1>Login</h1>

        <?php
        if (isset($user_err)) {
            echo "<h5>$user_err</h5>";
        }
        ?>

        <?php
        if (isset($notExist)) {
            echo "<h3>$notExist</h3>";
        }
        ?>

        <input type="text" placeholder="username" id="username" name="username" value="<?php if (isset($_COOKIE['username'])) echo $_COOKIE['username']; ?>">

        <?php
        if (isset($password_err)) {
            echo "<h5>$password_err</h5>";
        }
        ?>

        <input type="password" placeholder="password" id="password" name="password" value="<?php if (isset($_COOKIE['password'])) echo $_COOKIE['password']; ?>">

        <section class="remember">
            <input type="checkbox" name="keepLogin" value="1" id="keepLogin">
            <span>Remeber me</span>
        </section>

        <input type="submit" value="submit" id="login" name="submit">

        <p>you are not a member? <a href="./signup.php">Sign Up</a></p>

        <p>Or login as a Guest</p>
        <a href="home-guest.php">Guest</a>
    </form>
</body>

</html>