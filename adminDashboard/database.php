<?php
$servername = "localhost";
$username = "ijoba_admin";
$password = "admin123$";
$database = 'ijoba_ijobaDB';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
?>
