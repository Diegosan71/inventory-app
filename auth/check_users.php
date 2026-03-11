<?php
require_once "../config/database.php";
$database = new Database();
$db = $database->connect();

$stmt = $db->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($users);