<?php

session_start();
require_once "../config/database.php";

$database = new Database();
$db = $database->connect();

$id = $_GET["id"];

$query = "DELETE FROM products WHERE id = :id";

$stmt = $db->prepare($query);
$stmt->bindParam(":id",$id);

$stmt->execute();

header("Location: dashboard.php");
exit();