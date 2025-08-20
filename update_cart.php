<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: signin-signup.php");
    exit;
}

$user_id    = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity   = $_POST['quantity'];

if ($quantity > 0) {
    $sql = "UPDATE cart SET quantity=? WHERE user_id=? AND product_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $quantity, $user_id, $product_id);
    $stmt->execute();
}

header("Location: cart.php");
exit;
?>
