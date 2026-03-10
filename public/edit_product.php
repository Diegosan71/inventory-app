<?php

session_start();
require_once "../config/database.php";

$database = new Database();
$db = $database->connect();

$id = $_GET["id"];

$query = "SELECT * FROM products WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(":id",$id);
$stmt->execute();

$product = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER["REQUEST_METHOD"] == "POST"){

$name = $_POST["name"];
$price = $_POST["price"];
$stock = $_POST["stock"];

$update = "UPDATE products 
SET name=:name, price=:price, stock=:stock 
WHERE id=:id";

$stmt = $db->prepare($update);

$stmt->bindParam(":name",$name);
$stmt->bindParam(":price",$price);
$stmt->bindParam(":stock",$stock);
$stmt->bindParam(":id",$id);

$stmt->execute();

header("Location: dashboard.php");
exit();

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>Edit Product</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-body">

<h3 class="text-center mb-4">Edit Product</h3>

<form method="POST">

<div class="mb-3">
<label class="form-label">Name</label>
<input 
type="text" 
name="name" 
class="form-control"
value="<?php echo $product['name']; ?>" 
required>
</div>

<div class="mb-3">
<label class="form-label">Price</label>
<input 
type="number" 
step="0.01" 
name="price" 
class="form-control"
value="<?php echo $product['price']; ?>" 
required>
</div>

<div class="mb-3">
<label class="form-label">Stock</label>
<input 
type="number" 
name="stock" 
class="form-control"
value="<?php echo $product['stock']; ?>" 
required>
</div>

<div class="d-grid">
<button type="submit" class="btn btn-warning">
Update Product
</button>
</div>

<a href="dashboard.php" class="btn btn-secondary mt-3 w-100">
Back to Dashboard
</a>

</form>

</div>
</div>

</div>

</div>

</div>

</body>
</html>