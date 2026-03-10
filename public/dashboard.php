<?php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../auth/login.php");
    exit();
}

require_once "../config/database.php";

$database = new Database();
$db = $database->connect();

$query = "SELECT * FROM products ORDER BY created_at DESC";
$stmt = $db->prepare($query);
$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">    
<title>Inventory Dashboard</title>

<style>

body{
font-family: Arial;
margin:40px;
}

table{
width:100%;
border-collapse:collapse;
}

th,td{
padding:10px;
border:1px solid #ccc;
text-align:left;
}

th{
background:#f4f4f4;
}

button{
padding:5px 10px;
cursor:pointer;
}

.low-stock{
background-color:#ffcccc;
color:#900;
font-weight:bold;
}


</style>

</head>

<body>




<div class="container mt-5">

<h2 class="mb-4">Inventory Dashboard</h2>

<p>Welcome <?php echo $_SESSION["username"]; ?></p>

<a href="../auth/logout.php" class="btn btn-warning">Logout</a>

<br><br>

<a href="add_product.php" class="btn btn-primary">Add Product</a>
<br><br>

<input type="text" id="searchInput" placeholder="Search product..." onkeyup="searchProduct()" class="form-control mb-3">

<br><br>

<table id="productTable" class="table table-striped table-bordered">

<tr>
<th>Producto</th>
<th>Precio</th>
<th>Stock</th>
<th>Acciones</th>
</tr>

<?php foreach($products as $product): ?>

<tr class="<?php echo ($product['stock'] < 5) ? 'low-stock' : ''; ?>">

<td><?php echo $product["name"]; ?></td>

<td>$<?php echo $product["price"]; ?></td>

<td>
<?php echo $product["stock"]; ?>

<?php if($product["stock"] < 5): ?>
⚠ Low stock
<?php endif; ?>

</td>

<td>

<a class="btn btn-success" href="edit_product.php?id=<?php echo $product['id']; ?>">Edit</a>
<a class="btn btn-danger" href="delete_product.php?id=<?php echo $product['id']; ?>" 
onclick="return confirmDelete()">Delete</a>

</td>

</tr>

<?php endforeach; ?>

</table>

<script>

function confirmDelete(){
return confirm("Are you sure you want to delete this product?");
}

</script>

<script>

function searchProduct(){

let input = document.getElementById("searchInput");
let filter = input.value.toLowerCase();

let table = document.getElementById("productTable");
let rows = table.getElementsByTagName("tr");

for(let i = 1; i < rows.length; i++){

let productName = rows[i].getElementsByTagName("td")[0];

if(productName){

let text = productName.textContent || productName.innerText;

if(text.toLowerCase().indexOf(filter) > -1){

rows[i].style.display = "";

}else{

rows[i].style.display = "none";

}

}

}

}

</script>

</div>

</body>
</html>