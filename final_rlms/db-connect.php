<?php
$host     = 'localhost';
$username = 'tamgid';
$password = 'Tam214gid931@';
$dbname   ='final_project';

$conn = new mysqli($host, $username, $password, $dbname);
if(!$conn){
    die("Cannot connect to the database.". $conn->error);
}