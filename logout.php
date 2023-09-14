<?php
// connect to database
    include './includes/components/config.php';
//---------------------
session_destroy();
header("location: ./index.php");
?>