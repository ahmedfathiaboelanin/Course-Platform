<?php 
// connect to database
    $host='localhost';
    $user='root';
    $password='';
    $db='code';

    $con=mysqli_connect($host,$user,$password,$db);
// -------------------
session_start();
include 'includes/functions.php';