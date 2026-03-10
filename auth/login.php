<?php
session_start();
require_once "../config/database.php";

$database = new Database();
$db = $database->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
    $stmt = $db->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user["password"])) {

        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];

        header("Location: ../public/dashboard.php");
        exit();

    } else {
        $error = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>

<body>

<h2>Inventory Login</h2>

<?php if(isset($error)) echo "<p>$error</p>"; ?>

<form method="POST">

<label>Username</label>
<br>
<input type="text" name="username" required>

<br><br>

<label>Password</label>
<br>
<input type="password" name="password" required>

<br><br>

<button type="submit">Login</button>

</form>

</body>
</html>