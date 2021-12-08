<?php
$host = "localhost";
$userName = "root";
$password = "";
$dbName = "news_db";
try {
	$conn = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $userName, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	die("Error: " . $e->getMessage());
}
?>

