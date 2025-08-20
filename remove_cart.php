<?php
include 'db.php';
session_start();

// make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: signin-signup.php");
    exit();
}

$user_id = $_SESSION['user_id']; // ✅ actual logged in user

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    $sql = "DELETE FROM cart WHERE user_id=? AND product_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $product_id);

    if ($stmt->execute()) {
        header("Location: cart.php"); // refresh cart page
        exit();
    } else {
        echo "Error removing item!";
    }
}
?>
