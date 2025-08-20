<?php
include 'db.php';
session_start();

// ✅ Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "User not logged in!";
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // fetch cart items for this user
    $cartSql = "SELECT * FROM cart WHERE user_id = ?";
    $cartStmt = $conn->prepare($cartSql);
    $cartStmt->bind_param("i", $user_id);
    $cartStmt->execute();
    $cartResult = $cartStmt->get_result();

    if ($cartResult->num_rows == 0) {
        echo "Cart is empty!";
        exit;
    }

    // calculate total
    $total = 0;
    $items = [];
    while ($row = $cartResult->fetch_assoc()) {
        $subtotal = $row['product_price'] * $row['quantity']; // ✅ correct column
        $total += $subtotal;
        $items[] = $row;
    }

    // customer details
    $name    = $conn->real_escape_string($_POST['name']);
    $address = $conn->real_escape_string($_POST['address']);
    $phone   = $conn->real_escape_string($_POST['phone']);

    // insert into orders
    $orderSql = "INSERT INTO orders (user_id, customer_name, address, phone, total_price) 
                 VALUES (?, ?, ?, ?, ?)";
    $orderStmt = $conn->prepare($orderSql);
    $orderStmt->bind_param("isssd", $user_id, $name, $address, $phone, $total);
    $orderStmt->execute();
    $order_id = $orderStmt->insert_id;

    // insert into order_items
    $itemSql = "INSERT INTO order_items (order_id, product_id, product_name, size, quantity, price) 
                VALUES (?, ?, ?, ?, ?, ?)";
    $itemStmt = $conn->prepare($itemSql);

    foreach ($items as $item) {
        $itemStmt->bind_param(
            "iissid",
            $order_id,
            $item['product_id'],
            $item['product_name'],
            $item['size'],
            $item['quantity'],
            $item['product_price']
        );
        $itemStmt->execute();
    }

    // clear cart
    $clearSql = "DELETE FROM cart WHERE user_id = ?";
    $clearStmt = $conn->prepare($clearSql);
    $clearStmt->bind_param("i", $user_id);
    $clearStmt->execute();

    echo "success"; // ✅ will trigger JS popup
}
?>
