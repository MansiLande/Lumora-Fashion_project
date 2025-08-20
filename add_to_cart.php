<?php 
include 'db.php';
session_start();

// check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin-signup.php");
    exit;
}

$user_id = $_SESSION['user_id']; // ✅ logged-in user id

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $size       = $_POST['size'];   // ✅ capture size

    // ✅ fetch name & price from products
    $query = $conn->prepare("SELECT name, price FROM products WHERE id = ?");
    $query->bind_param("i", $product_id);
    $query->execute();
    $product = $query->get_result()->fetch_assoc();

    if (!$product) {
        die("Product not found!");
    }

    $product_name  = $product['name'];
    $product_price = $product['price'];

    // ✅ check inside cart (same product + same size for same user)
    $check = $conn->prepare("SELECT * FROM cart WHERE product_id=? AND user_id=? AND size=?");
    $check->bind_param("iis", $product_id, $user_id, $size);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // already in cart → update quantity
        $stmt = $conn->prepare("UPDATE cart 
                                SET quantity = quantity + 1 
                                WHERE product_id=? AND user_id=? AND size=?");
        $stmt->bind_param("iis", $product_id, $user_id, $size);
        $stmt->execute();
    } else {
        // not in cart → insert new row with correct name & price
        $stmt = $conn->prepare("INSERT INTO cart (product_id, product_name, product_price, size, quantity, user_id) 
                                VALUES (?, ?, ?, ?, 1, ?)");
        $stmt->bind_param("isdsi", $product_id, $product_name, $product_price, $size, $user_id);
        $stmt->execute();
    }

    header("Location: cart.php");
    exit();
}
?>
