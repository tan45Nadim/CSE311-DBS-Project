<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "PatientQ";

    $connect = mysqli_connect($servername, $username, $password, $dbname);

    if (!$connect) {
        die("Connection Failed!".mysqli_connect_error());
    }
?>
