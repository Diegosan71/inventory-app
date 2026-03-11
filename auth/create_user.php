<?php
require_once "../config/database.php";

$database = new Database();
$db = $database->connect();

// Usuario que quieres crear
$username = "admin";        // Cambia si quieres otro nombre
$password = "123456";       // Cambia si quieres otra contraseña

// Generar hash seguro
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insertar en la base de datos
try {
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $hashed_password);
    $stmt->execute();
    echo "Usuario '$username' creado correctamente con contraseña '$password'";
} catch (PDOException $e) {
    echo "Error al crear usuario: " . $e->getMessage();
}
?>