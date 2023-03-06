<?php

$host_db_name = "localhost";
$user_db_name = "root";
$password_db_name = "";
$databse_name = "examspot";

$con = mysqli_connect($host_db_name, $user_db_name, $password_db_name, $databse_name);

// checking for connection.
if (!$con) {
    // display the error message.
    echo '<center><h3 style="margin-top:50px;color:red;">Invalid Server Connection.</h3></center>';
    exit;
}
