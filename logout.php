<?php
session_start();
include("./include/connections.php");
session_unset();
session_destroy();
header('location: login.php');
?>
