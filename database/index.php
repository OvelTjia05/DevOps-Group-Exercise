<?php
    date_default_timezone_set('Asia/Makassar');

    $hostname = "localhost";
    $username = "root";
    $password = "12345";
    $database_name = "db_unklab";
    $port = 3307;

    $conn= mysqli_connect($hostname, $username, $password, $database_name, $port);

    if($conn->connect_error){
        die("Connection failed: " . mysqli_connect_error());
    }

?>