<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'login';

try{
	$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch(PDOEException $e){
	die( "Connection failed: " . $e->getMessage());
}
?>