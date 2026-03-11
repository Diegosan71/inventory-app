<?php
require_once "../config/database.php";

// Crear la conexión
$database = new Database();
$db = $database->connect();

if (!$db) {
    die("Error: No se pudo conectar a la base de datos.");
}

// Probar una consulta simple
try {
    $stmt = $db->prepare("SELECT COUNT(*) AS total FROM users");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Conexión exitosa. Usuarios en la base de datos: " . $row['total'];
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}
?>