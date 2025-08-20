<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: signin-signup.php");
    exit;
}

$user_id    = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

$stmt = $conn->prepare("DELETE FROM wishlist WHERE user_id=? AND product_id=?");
$stmt->bind_param("ii", $user_id, $product_id);
$stmt->execute();

header("Location: wishlist_view.php"); 
exit;
