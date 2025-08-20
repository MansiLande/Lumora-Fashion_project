<?php 
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: signin-signup.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT p.* FROM wishlist w 
        JOIN products p ON w.product_id = p.id 
        WHERE w.user_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Wishlist</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <style>
    body {
      background-color: #0a0a0a;
      font-family: "Playfair Display", serif;
      color: #f5f5f5;
      margin: 0;
      padding: 40px;
    }

    h2 {
      text-align: center;
      font-size: 2.8rem;
      color: ;
      margin-bottom: 40px;
      letter-spacing: 2px;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 25px;
      max-width: 1600px;
      margin: auto;
    }

    .product-card {
      background: #121212;
      padding: 18px;
      border-radius: 18px;
      text-align: center;
      box-shadow: 0 0 12px rgba(255, 215, 0, 0.12);
      transition: transform 0.3s, box-shadow 0.3s;
      position: relative;
    }

    .product-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 0 20px rgba(255, 215, 0, 0.25);
    }

    .product-card img {
      width: 100%;
      height: 300px; /* equal size for all */
      object-fit: cover;
      border-radius: 12px;
      border: 2px solid gold;
      margin-bottom: 15px;
    }

    .product-card h3 {
      font-size: 1.4rem;
      margin: 10px 0;
      color: #fff;
      font-weight: 600;
    }

    .product-card p {
      font-size: 1.3rem;
      color: gold;
      margin-bottom: 15px;
      font-weight: bold;
    }

    /* Transparent Add to Cart Button */
    .product-card form button {
      padding: 12px 18px;
      background: transparent;
      border: 2px solid gold;
      border-radius: 10px;
      color: gold;
      font-size: 1.1rem;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      margin: auto;
    }

    .product-card form button:hover,
    .product-card form button:active {
      background: gold;
      color: #000;
      transform: scale(1.05);
    }

    /* Remove button (small red icon in corner) */
    .remove-btn {
      position: absolute;
      top: 12px;
      right: 12px;
      background: transparent;
      border: none;
      cursor: pointer;
      font-size: 1.3rem;
      color: #ff4d4d;
      transition: 0.3s;
    }

    .remove-btn:hover {
      color: #ff1a1a;
      transform: scale(1.2);
    }
  </style>
</head>
<body>
  <h2>My Wishlist</h2>
  <div class="product-grid">
    <?php while ($row = $result->fetch_assoc()) { ?>
      <div class="product-card">
        <!-- Remove button -->
        <form method="POST" action="wishlist_remove.php">
          <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
          <button type="submit" class="remove-btn" title="Remove from Wishlist">
            <i class="fa-solid fa-xmark"></i>
          </button>
        </form>

        <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
        <h3><?php echo $row['name']; ?></h3>
        <p>₹<?php echo $row['price']; ?></p>
        <form method="POST" action="add_to_cart.php">
          <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
          <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
          <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
          <input type="hidden" name="quantity" value="1">
          <input type="hidden" name="size" value="M">
          <button type="submit">
            <i class="fa-solid fa-cart-shopping"></i> Add to Cart
          </button>
        </form>
      </div>
    <?php } ?>
  </div>
</body>
</html>
