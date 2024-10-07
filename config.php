<?php
$host = 'localhost';
$dbname = 'website_cinta';
$username = 'root'; // Ganti sesuai dengan user database-mu
$password = '';     // Ganti dengan password database-mu

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>