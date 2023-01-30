<?php
// For connecting database creating variables
$username = "root";
$password = "example";
$dbname = "news"; 

// Using try catch method for database 
try{
    $pdo = new PDO("mysql:host=db;dbname=$dbname", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
     } 
     catch(PDOExecption $e) {
    
        echo "Connection Failed : " . $e->getMessage();
     } 
     ?>


