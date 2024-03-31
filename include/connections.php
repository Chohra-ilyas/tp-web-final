<?php

$conn = mysqli_connect("localhost","root","","classetud");

if(!$conn){
    die("Error". mysqli_connect_error());
}