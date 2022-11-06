<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'awa';


$conn = new MySQLi($db_host,$db_user,$db_pass,$db_name);

if ($conn->connect_error) {
    # code...
    die('database connection error' .$conn->connect_error);
}
