<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "haaniyah_14804";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn){
    die("Sorry we failed to connect: ". mysqli_connect_error());
}

?>


