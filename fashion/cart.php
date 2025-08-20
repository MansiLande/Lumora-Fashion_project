<?php  
include 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: signin-signup.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch cart items
$sql = "SELECT c.product_id, c.quantity, c.size, p.name, p.price, p.image 
        FROM cart c
        JOIN products p ON c.product_id = p.id
        WHERE c.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Cart</title>
  <!-- Playfair Display Font -->
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: "Playfair Display", serif;
      background-color: #0a0a0a;
      color: #e5e5e5;
      margin: 0;
      padding: 40px;
    }
    h1 {
      text-align: center;
      font-size: 2.5rem;
      color: white;
      margin-bottom: 40px;
      letter-spacing: 1px;
      margin-top:3px;
    }
    .cart-container {
      display: grid;
      grid-template-columns: 2fr 1fr;
      gap: 30px;
      max-width: 1800px;
      margin: auto;
    }
    .cart-items, .order-summary {
      background: #121212;
      padding: 25px;
      border-radius: 18px;
      box-shadow: 0 0 15px rgba(255, 215, 0, 0.15);
    }
    .cart-item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 20px;
      padding-bottom: 20px;
      border-bottom: 1px solid rgba(255, 215, 0, 0.2);
    }
    .cart-item img {
      width: 290px;
      height: 300px;
      object-fit: cover;
      border-radius: 12px;
      margin-right: 20px;
      border: 2px solid gold;
    }
    .cart-details {
      flex: 1;
    }
    .cart-details h3 {
      margin: 0 0 8px;
      font-size: 1.5rem;
      color: #fff;
    }
    .cart-details p {
      margin: 5px 0;
      font-size:1.5rem;
    }
    select {
      padding: 6px 10px;
      margin-top: 6px;
      border-radius: 6px;
      border: 1px solid gold;
      background: #1e1e1e;
      color: #fff;
      font-family: "Playfair Display", serif;
      font-size:1.2rem;
      margin-left:10px;
    }
    /* Quantity input */
.qty-input {
  width: 70px;
  padding: 8px 10px;
  border-radius: 8px;
  border: 1px solid gold;
  background: #1e1e1e;
  color: #ffffffff;
  font-size: 1.3rem;
  text-align: center;
  margin-right: 10px;
  font-family: "Playfair Display", serif;
  margin-left:10px;
}

/* Update button */
.update-btn {
  padding: 8px 16px;
  border: none;
  border-radius: 8px;
  background: gold;
  color: #000;
  cursor: pointer;
  font-size: 1.2rem;
  font-weight: bold;
  transition: 0.3s;
  font-family: "Playfair Display", serif;
}

.update-btn:hover {
  background: #e5c100;
}

/* Make the form inline */
.quantity-form {
  display: flex;
  align-items: center;
  margin-top: 10px;
}

.qty-label {
  margin: 0 0 8px;
      font-size: 1.5rem;
      color: #fff;
  margin-right: 10px;
  font-family: "Playfair Display", serif;
}


    .remove-btn {
      margin-top: 45px;
      padding: 8px 16px;
      border: none;
      border-radius: 8px;
      background: #b30000;
      color: #fff;
      cursor: pointer;
      transition: 0.3s;
      font-family: inherit;
      font-size:1.2rem;
    }
    .remove-btn:hover {
      background: #e60000;
    }
    .price {
      font-size: 1.4rem;
      font-weight: bold;
      color: gold;
    }
    .order-summary {
  position: fixed;
  right: 190px;          /* distance from right edge */
  top: 50%;             /* move to vertical middle */
  transform: translateY(-50%);  /* center vertically */
  
  background: #191919ff;
  padding: 25px;
  border-radius: 18px;
  box-shadow: 0 0 15px rgba(255, 215, 0, 0.15);
  width: 440px;          /* fixed width so it looks neat */
}

    .order-summary h2 {
      text-align: center;
      color: gold;
      margin-bottom: 20px;
      font-size: 2.4rem;
    }
     /* Bigger text inside inputs */
.order-summary input, 
.order-summary textarea {
  width: 100%;
  height: 50px;
  margin-bottom: 18px;
  padding: 14px;
  border-radius: 10px;
  border: 1px solid gold;
  background: #1e1e1e;
  color: #fff;
  font-size: 1.3rem;   /* ✅ bigger text */
  font-family: "Playfair Display", serif;
    }

    /* Lighter placeholders */
.order-summary input::placeholder,
.order-summary textarea::placeholder {
  color: rgba(255, 255, 255, 0.5);  /* ✅ light grey */
  font-size: 1.2rem;
}
    .order-summary button {
      width: 180px;
      padding: 14px;
      background: gold;
      border: none;
      border-radius: 10px;
      color: #000;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      font-family: "Playfair Display", serif;
      margin-top:10px;
    }
    .order-summary button:hover {
      background: #e5c100;
    }
    .total {
      font-size: 1.8rem;
      text-align: right;
      margin-top: 20px;
      font-weight: bold;
      color: gold;
    }
    /* Popup */
    #orderPopup {
      display: none;
      position: fixed;
      top: 30%;
      left: 50%;
      transform: translate(-50%,-50%);
      background: #121212;
      padding: 40px;
      border-radius: 16px;
      color: gold;
      text-align: center;
      box-shadow: 0 0 30px rgba(255, 215, 0, 0.3);
      z-index: 1000;
      max-width: 400px;
      width: 90%;
    }
    #orderPopup button {
      margin-top: 20px;
      padding: 12px 24px;
      border: none;
      border-radius: 10px;
      background: gold;
      color: #000;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      font-family: "Playfair Display", serif;
    }
    #orderPopup button:hover {
      background: #e5c100;
    }

  </style>
</head>
<body>



<h1>🛒 My Cart</h1>
<div class="cart-container">

  <!-- Cart Items -->
  <div class="cart-items">
    <?php 
    $total = 0;
    while ($row = $result->fetch_assoc()): 
      $subtotal = $row['price'] * $row['quantity'];
      $total += $subtotal;
    ?>
    <div class="cart-item">
      <img src="<?= $row['image'] ?>" alt="<?= $row['name'] ?>">
      <div class="cart-details">
        <h3><?= $row['name'] ?></h3>
        <p>Price: <span class="price">₹<?= $row['price'] ?></span></p>
        <label style="font-size: 1.6rem;">Size:     </label>
        <select>
          <option value="S" <?= $row['size']=='S'?'selected':'' ?>>S</option>
          <option value="M" <?= $row['size']=='M'?'selected':'' ?>>M</option>
          <option value="L" <?= $row['size']=='L'?'selected':'' ?>>L</option>
          <option value="XL" <?= $row['size']=='XL'?'selected':'' ?>>XL</option>
        </select>
        <form action="update_cart.php" method="post" class="quantity-form">
  <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">

  <label for="qty-<?php echo $row['product_id']; ?>" class="qty-label">Quantity:</label>
  <input type="number" id="qty-<?php echo $row['product_id']; ?>" name="quantity" value="<?php echo $row['quantity']; ?>" min="1" class="qty-input">
  
  <button type="submit" class="update-btn">Update</button>
</form>


        <p>Subtotal: <span class="price">₹<?= $subtotal ?></span></p>

        <!-- Remove button -->
        <form action="remove_cart.php" method="post">
          <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
          <button type="submit" class="remove-btn">Remove</button>
        </form>
      </div>
    </div>
    <?php endwhile; ?>
    <div class="total">Total: ₹<?= $total ?></div>
  </div>

  <!-- Place Order Form -->
  <div class="order-summary">
    <h2>Place Order</h2>
    <form action="place_order.php" method="post">
      <input type="text" name="name" placeholder="Your Name" required>
      <textarea name="address" placeholder="Your Address" required></textarea>
      <input type="text" name="phone" placeholder="Phone Number" required>
      <button type="submit">Place Order</button>
    </form>
  </div>
</div>

<!-- Popup -->
<div id="orderPopup">
  <h2>✅ Order Placed Successfully!</h2>
  <button onclick="closePopup()">OK</button>
</div>

<script>
document.querySelector(".order-summary form").addEventListener("submit", function(e){
  e.preventDefault(); 
  let formData = new FormData(this);

  fetch("place_order.php", {
    method: "POST",
    body: formData
  })
  .then(res => res.text())
  .then(data => {
    if(data.trim() === "success"){
      document.getElementById("orderPopup").style.display = "block";
    } else {
      alert("Cart is empty!");
    }
  });
});

function closePopup(){
  document.getElementById("orderPopup").style.display = "none";
  window.location.reload();
}
</script>

</body>
</html>
