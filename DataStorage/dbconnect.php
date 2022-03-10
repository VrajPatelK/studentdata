<?php
$servername = "localhost";
$hostname = "root";
$password ="";
$db_name ="studentdata";

$connection = mysqli_connect($servername , $hostname , $password ,$db_name);

if(!$connection)
    die("Lost your connection with MySql database". mysqli_connect_error());
?>