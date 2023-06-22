<?php
  
try {
    $servername = "localhost";
    $dbname = "healthhub";
    $username = "root";
    $password = "";
 
    $conn = new PDO("mysql:host=$servername; dbname=healthhub", $username, $password);
     
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
} catch(PDOException $e) {
    echo "Connection failed: "
        . $e->getMessage();
}