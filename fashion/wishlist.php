<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: signin-signup.php");
    exit;
}

$user_id    = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

// check if product already in wishlist
$check = $conn->prepare("SELECT * FROM wishlist WHERE user_id=? AND product_id=?");
$check->bind_param("ii", $user_id, $product_id);
$check->execute();
$result = $check->get_result();

if ($result->num_rows > 0) {
    // remove (toggle)
    $stmt = $conn->prepare("DELETE FROM wishlist WHERE user_id=? AND product_id=?");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
} else {
    // add
    $stmt = $conn->prepare("INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
}

header("Location: wishlist_view.php");
exit;
