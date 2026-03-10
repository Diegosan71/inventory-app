<?php

require_once "../config/database.php";

$database = new Database();
$db = $database->connect();

if ($db) {
    echo "Database connected successfully!";
}