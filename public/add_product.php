<?php

session_start();
require_once "../config/database.php";

$database = new Database();
$db = $database->connect();

if($_SERVER["REQUEST_METHOD"] == "POST"){

$name = $_POST["name"];
$price = $_POST["price"];
$stock = $_POST["stock"];

$query = "INSERT INTO products (name, price, stock) VALUES (:name, :price, :stock)";

$stmt = $db->prepare($query);

$stmt->bindParam(":name",$name);
$stmt->bindParam(":price",$price);
$stmt->bindParam(":stock",$stock);

$stmt->execute();

header("Location: dashboard.php");
exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Add Product</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-body">

<h3 class="mb-4 text-center">Add Product</h3>

<form method="POST">

<div class="mb-3">
<label class="form-label">Name</label>
<input type="text" name="name" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Price</label>
<input type="number" step="0.01" name="price" class="form-control" required>
</div>

<div class="mb-3">
<label class="form-label">Stock</label>
<input type="number" name="stock" class="form-control" required>
</div>

<div class="d-grid">
<button type="submit" class="btn btn-success">Save Product</button>
</div>

</form>

</div>
</div>

</div>

</div>

</div>

</body>
</html>