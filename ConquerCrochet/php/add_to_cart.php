<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "conquercrochet";

if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $sql = "SELECT product_id, name, price, image_url FROM Shop WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $item = $result->fetch_assoc();

    if ($item) {
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            $_SESSION['cart'][$product_id] = [
                "name" => $item['name'],
                "price" => $item['price'],
                "image" => $item['image_url'],
                "quantity" => 1
            ];
            
        }
        echo "<p>" . htmlspecialchars($item['name']) . " added to cart!</p>";
    } else {
        echo "<p>Item not found.</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
