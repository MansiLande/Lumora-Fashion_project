<?php
include '../db.php';

// fetch handbags products
$result = $conn->query("SELECT * FROM products WHERE category='CasualTops'");
?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: signin-signup.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Category | HandBags</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap"
      rel="stylesheet"
    />
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body,
      html {
        font-family: "Playfair Display", serif;
        background-color: #000000; /* Just so navbar is visible */
      }

      /* nav section */
      .main-navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding: 22px 35px;
        min-height: 80px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: rgba(0, 0, 0, 0.2) !important;
        backdrop-filter: blur(6px);
        z-index: 20;
        font-family: "Playfair Display", serif;
      }

      .nav-left {
        display: flex;
        align-items: center;
        gap: 10px;
      }

      .navbar-logo {
        display: block; /* Always visible */
        font-size: 30px;
        color: white;
        font-family: "Playfair Display", serif;
      }

      .nav-left a {
        color: white;
        text-decoration: none;
        padding: 10px 15px;
        transition: all 0.3s ease;
        position: relative;
      }

      .nav-left a:hover {
        color: #000000;
        background-color: white;
        border-radius: 6px;
      }

    
     /* Right section of navbar */
      .nav-right {
        display: flex;
        align-items: center;
        gap: 28px;
      }

      .search-bar {
        display: flex;
        align-items: center;
        border-bottom: 1px solid white;
        padding-bottom: 2px;
      }

      .search-bar input {
        background: transparent;
        border: none;
        outline: none;
        color: white;
        padding-left: 5px;
        font-size: 14px;
        width: 140px;
      }

      .search-bar input::placeholder {
        color: white;
        opacity: 0.7;
      }

      .search-bar .fa-search {
        font-size: 18px;
        color: transparent;
        -webkit-text-stroke: 1.2px #ffffff; /* White outline */
        transition: all 0.4s ease;
      }

      .search-bar .fa-search:hover {
        color: #ffffff; /* Fill white on hover */
        -webkit-text-stroke: 0;
        transform: scale(1.2);
      }

      .signin {
        color: white;
        border: 1px solid white;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: background-color 0.3s ease, color 0.3s ease;
      }

      .signin:hover {
        background-color: white;
        color: black;
      }

      .cart-icon i,
      .bookmark-icon i {
        font-size: 28px;
        color: transparent;
        -webkit-text-stroke: 1.4px #ffffff;
        transition: all 0.4s ease;
        margin: 0 8px;
      }

      .cart-icon:hover i,
      .bookmark-icon:hover i {
        color: #ffffff;
        -webkit-text-stroke: 0;
        transform: scale(1.2);
      }

      .bookmark-icon i {
        font-size: 28px;
        color: transparent;
        -webkit-text-stroke: 1.4px #ffffff;
        transition: all 0.4s ease;
        margin: 0 8px;
      }

      .bookmark-icon:hover i {
        font-family: "Font Awesome 6 Free";
        font-weight: 900; /* solid style */
        color: #ffffff;
        -webkit-text-stroke: 0;
        transform: scale(1.2);
      }
      
      /* Dropdown card */
.profile-card {
  display: none;
  position: absolute;
  top: 120%; /* just below the button */
  right: 0;
  background: white;
  color: black;
  padding: 15px;
  border-radius: 10px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  min-width: 220px;
  z-index: 1000;
  text-align: left;
}

/* User email */
.profile-card .user-email {
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 12px;
  color: #333;
  word-break: break-word;
}

/* Logout button */
.logout-btn {
  display: block;
  width: 100%;
  text-align: center;
  background: #ff4d4d;
  color: white;
  text-decoration: none;
  padding: 8px 0;
  border-radius: 6px;
  transition: background 0.3s ease;
  font-size: 14px;
}

.logout-btn:hover {
  background: #e60000;
}

/* === Profile Button === */
.profile-btn {
  background: transparent;
  border: 2px solid white;
  color: white;
  padding: 8px 16px;
  border-radius: 8px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-size: 14px;
}

.profile-btn:hover {
  background: white;
  color: black;
}

/* === Dropdown wrapper === */
.profile-dropdown {
  position: relative;
  display: inline-block;
  margin-left: 15px;
}

/* === Card Dropdown === */
./* === Card Dropdown === */
.profile-card {
  display: none;
  position: absolute;
  top: 110%;
  right: 0;
  background: #fffcfc;
  color: black;
  padding: 20px; /* more inner space */
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
  min-width: 250px; /* increase width */
  min-height: 120px; /* give more height */
  z-index: 1000;
}

.profile-card .user-email {
  font-size: 16px;
  margin: 0 0 8px;
  color: #000000;
}

.logout-btn {
  display: block;
  text-align: center;
  padding: 8px;
  background: #ff4d4d;
  color: white;
  border-radius: 6px;
  text-decoration: none;
  transition: background 0.3s ease;
  margin-top: 8px;
}


.logout-btn:hover {
  background: #e60000;
}

      .sub-nav {
        display: flex;
        align-items: center;
        gap: 8px;
        background: transparent;
        padding: 10px 0;
        margin-top: 90px;
        padding-left: 40px;
      }

      .sub-nav a {
        color: white;
        text-decoration: none;
        font-size: 1.3rem;
        transition: color 0.3s ease;
      }

      .sub-nav a:hover {
        color: gold;
      }

      .sub-nav a:not(:last-child)::after {
        content: "|";
        color: white;
        margin-left: 8px;
      }

      .circle-section {
        text-align: center;
        padding: 30px 0;
      }

      .circle-container {
        display: flex;
        justify-content: center;
        gap: 80px;
        flex-wrap: wrap;
        padding-left: 40px; /* adjust as needed */
        justify-content: flex-start; /* left aligned */
        margin-left: 0;
      }

      .circle-item {
        text-align: center;
      }

      .circle-item a {
        display: inline-block;
        text-decoration: none;
        color: white;
      }

      .circle-item img {
        width: 220px;
        height: 220px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid transparent;
        transition: transform 0.3s ease, border-color 0.3s ease;
      }

      .circle-item span {
        display: block;
        margin-top: 8px;
        font-size: 14px;
      }

      .circle-item:hover img {
        transform: scale(1.08);
      }

      .circle-item.selected img {
        border-color: gold; /* Highlight for selected */
      }

      /* Section background */
      .product-section {
        background: #000;
        padding: 30px;
      }

      /* 3 cards side by side */
      .product-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr); /* 3 per row */
        gap: 20px;
      }

      .product-card {
        background: #111;
        border-radius: 12px;
        padding: 15px;
        text-align: center;
        color: white;
        position: relative;
        box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1);
      }

      .image-wrapper {
        position: relative;
      }

      .image-wrapper img {
        width: 100%;
        border-radius: 10px;
        cursor: pointer;
      }

      .price {
        font-size: 1.6rem;
        margin: 8px 0;
        color: gold; /* ✅ gold color */
      }

      .delivery {
        font-size: 16px;
        color: #aaa;
      }

      .product-bookmark {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 28px;
        color: white;
        cursor: pointer;
        transition: 0.3s;
      }

      /* when clicked */
      .product-bookmark.active {
        font-family: "Font Awesome 6 Free";
        font-weight: 900; /* solid */
        color: white; /* ✅ fills white */
      }

      .card-actions {
        display: flex;
        align-items: center;
        gap: 220px; /* small space between button & rating */
        margin-top: 10px;
      }

      .cart-btn {
        background: #000;
        color: white;
        padding: 8px 14px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 1.3rem;
        display: flex;
        align-items: center;
        gap: 6px;
      }
      .cart-btn.active {
        background: white;
        color: black;
      }

      .rating {
        font-size: 1.6rem; /* slightly bigger */
        color: green; /* green color */
        font-weight: bold;
      }

      /* Modal container */
      .image-modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        justify-content: center;
        align-items: center;
      }

      /* Modal content */
      .modal-content {
        max-width: 90%;
        max-height: 90%;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      /* Wrapper around image + close button */
      .modal-image-wrapper {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      /* Popup Image */
      #modalImg {
        max-width: 80vw; /* always same proportion */
        max-height: 80vh;
        width: auto;
        height: auto;
        object-fit: contain; /* keeps uniform look */
        border-radius: 8px;
      }

      /* Close button */
      .modal-close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 28px;
        color: white;
        cursor: pointer;
        font-weight: bold;
      }
      .image-wrapper {
  position: relative;
  width: 100%;
  height: 600px; /* fixed height for all cards */
  overflow: hidden;
  border-radius: 10px;
}

.image-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover; /* crops & fits nicely */
  border-radius: 10px;
  cursor: pointer;
}

.occasion-title {
  color: white;
  font-size: 2rem;
  margin: 30px 0 20px;
  text-align: left; /* or center, your choice */
}

    </style>
  </head>
  <body>
   
   <!-- Nav bar section -->
   <header class="main-navbar">
  <div class="nav-left">
    <h1 class="navbar-logo">LUMORA</h1>
    <a href="../index.php">Home</a>
<a href="../index.php#new-arrivals">New Arrival</a>
<a href="../index.php#shop-by-category">Category</a>
<a href="../index.php#trending-banner-container">Trendings</a>
<a href="../index.php#occasions">Occasions</a>
<a href="../index.php#designers">Designers</a>
<a href="../index.php#book-appointment">Meet Stylist</a>
<a href="../index.php#about-lumora">About Brand</a>
<a href="../index.php#reviews-section">Reviews</a>

  </div>

          <div class="nav-right">
        <div class="search-bar">
          <i class="fas fa-search nav-icon"></i>
          <input type="text" placeholder="  SEARCH" />
        </div>
        <div class="cart-icon">
          <a href="../cart.php">
            <i class="fa-solid fa-cart-shopping"></i>
          </a>
        </div>
        <div class="bookmark-icon">
          <a href="../wishlist_view.php">
            <i class="fa-regular fa-bookmark"></i>
          </a>
        </div>
         <?php if (isset($_SESSION['user_id'])): ?>
  <!-- Profile Dropdown -->
  <div class="profile-dropdown">
    <button class="profile-btn" onclick="toggleProfileCard()">
      <i class="fa-solid fa-user"></i> My Profile
    </button>

    <!-- Card Dropdown -->
    <div class="profile-card" id="profileCard">
      <p class="user-email"><?= htmlspecialchars($_SESSION['email']); ?></p>
      <a href="logout.php" class="logout-btn">Logout</a>
    </div>
  </div>
<?php else: ?>
  <a href="signin-signup.php" class="signin">SIGN IN</a>
<?php endif; ?>
<script>
function toggleProfileCard() {
  const card = document.getElementById('profileCard');
  card.style.display = (card.style.display === 'block') ? 'none' : 'block';
}

// Close when clicking outside
document.addEventListener("click", function(e) {
  const dropdown = document.querySelector(".profile-dropdown");
  if (!dropdown.contains(e.target)) {
    document.getElementById("profileCard").style.display = "none";
  }
});
</script>
      </div>
    </header>

    <!-- Sub Navigation Section -->
    <section class="sub-nav">
      <a href="#">Category</a> | <a href="#">HandBags</a> |
      <a href="#" id="current-category">Tote Bags</a>
    </section>

    <section class="circle-section">
      <div class="circle-container">
        <div class="circle-item selected">
          <a href="#wedding">
            <img
              src="wedding.jpg"
              alt="Tote Bags"
            />
            <span>Wedding Edit</span>
          </a>
        </div>

        <div class="circle-item selected">
          <a href="#summer">
            <img
              src="summer.jpg"
              alt="Satchel Bag"
            />
            <span>Summer Vibes</span>
          </a>
        </div>

        <div class="circle-item selected">
          <a href="#runway">
            <img
              src="runway.jpg"
              alt="Clutch Bag"
            />
            <span>Runway Looks</span>
          </a>
        </div>

        <div class="circle-item selected">
          <a href="#vacation">
            <img
              src="vacation.jpg"
              alt="Crossbody Bag"
            />
            <span>Vacation WardBoard</span>
          </a>
        </div>

        <div class="circle-item selected">
          <a href="#party">
            <img
              src="party.jpg"
              alt="Backpack Bag"
            />
            <span>Party Perfect</span>
          </a>
        </div>

         <div class="circle-item selected">
          <a href="#winter">
            <img
              src="winter.jpg"
              alt="Backpack Bag"
            />
            <span>Winter Warmth</span>
          </a>
        </div>
      </div>
    </section>
    <script>
      const categoryText = document.getElementById("current-category");
      const circleItems = document.querySelectorAll(".circle-item");

      circleItems.forEach((item) => {
        item.addEventListener("click", () => {
  const newCategory = item.querySelector("span").textContent;
  categoryText.textContent = newCategory;
  ...
});

          const newCategory = item.querySelector("span").textContent;
          categoryText.textContent = newCategory;

          // optional: highlight the clicked circle
          document
            .querySelectorAll(".circle-item")
            .forEach((c) => c.classList.remove("selected"));
          item.classList.add("selected");
        });
      });
    </script>



 <section id="wedding" class="product-section">  
  <h2 class="occasion-title">Wedding Edit</h2>
  <div class="product-grid">
    <?php 
    // ✅ use category instead of occasion
    $weddingProducts = $conn->query("SELECT * FROM products WHERE category='Wedding' LIMIT 8");
    while ($row = $weddingProducts->fetch_assoc()): ?>
      
      <div class="product-card">
        <div class="image-wrapper">
          <!-- ❌ Removed Offer Badge -->

          <img
            src="../<?= $row['image']; ?>"
            alt="<?= $row['name']; ?>"
            class="product-img"
          />

          <!-- ✅ Wishlist Button -->
          <form method="POST" action="../wishlist.php" class="wishlist-form">
            <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
            <input type="hidden" name="product_name" value="<?= $row['name']; ?>">
            <button type="submit" class="wishlist-btn">
              <i class="fa-regular fa-bookmark product-bookmark"></i>
            </button>
          </form>
        </div>

        <!-- ✅ Product Info -->
        <h3><?= $row['name']; ?></h3>
        <p class="price">₹<?= $row['price']; ?></p>

        <div class="card-actions">
          <!-- Add to Cart -->
          <form action="../add_to_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?= $row['id']; ?>" />
            <input type="hidden" name="product_name" value="<?= $row['name']; ?>" />
            <input type="hidden" name="product_price" value="<?= $row['price']; ?>" />
            <button type="submit" class="cart-btn">
              <i class="fa-solid fa-cart-shopping"></i> Add to Cart
            </button>
          </form>
          
          <!-- Rating -->
          <div class="rating"><span><?= $row['rating']; ?> ★</span></div>
        </div>
      </div>
      
    <?php endwhile; ?>
  </div>
</section>


<section id="summer" class="product-section">   
  <h2 class="occasion-title">Summer Vibes</h2>
  <div class="product-grid">
    <?php 
    // ✅ use category instead of occasion
    $summerProducts = $conn->query("SELECT * FROM products WHERE category='Summer' LIMIT 8");
    while ($row = $summerProducts->fetch_assoc()): ?>
      
      <div class="product-card">
        <div class="image-wrapper">
          <!-- ❌ Removed Offer Badge -->

          <img
            src="../<?= $row['image']; ?>"
            alt="<?= $row['name']; ?>"
            class="product-img"
          />

          <!-- ✅ Wishlist Button -->
          <form method="POST" action="../wishlist.php" class="wishlist-form">
            <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
            <input type="hidden" name="product_name" value="<?= $row['name']; ?>">
            <button type="submit" class="wishlist-btn">
              <i class="fa-regular fa-bookmark product-bookmark"></i>
            </button>
          </form>
        </div>

        <!-- ✅ Product Info -->
        <h3><?= $row['name']; ?></h3>
        <p class="price">₹<?= $row['price']; ?></p>

        <div class="card-actions">
          <!-- Add to Cart -->
          <form action="../add_to_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?= $row['id']; ?>" />
            <input type="hidden" name="product_name" value="<?= $row['name']; ?>" />
            <input type="hidden" name="product_price" value="<?= $row['price']; ?>" />
            <button type="submit" class="cart-btn">
              <i class="fa-solid fa-cart-shopping"></i> Add to Cart
            </button>
          </form>
          
          <!-- Rating -->
          <div class="rating"><span><?= $row['rating']; ?> ★</span></div>
        </div>
      </div>
      
    <?php endwhile; ?>
  </div>
</section>


<section id="runway" class="product-section">   
  <h2 class="occasion-title">Runway Look</h2>
  <div class="product-grid">
    <?php 
    // ✅ use category instead of occasion
    $runwayProducts = $conn->query("SELECT * FROM products WHERE category='Runway' LIMIT 8");
    while ($row = $runwayProducts->fetch_assoc()): ?>
      
      <div class="product-card">
        <div class="image-wrapper">
          <!-- ❌ Removed Offer Badge -->

          <img
            src="../<?= $row['image']; ?>"
            alt="<?= $row['name']; ?>"
            class="product-img"
          />

          <!-- ✅ Wishlist Button -->
          <form method="POST" action="../wishlist.php" class="wishlist-form">
            <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
            <input type="hidden" name="product_name" value="<?= $row['name']; ?>">
            <button type="submit" class="wishlist-btn">
              <i class="fa-regular fa-bookmark product-bookmark"></i>
            </button>
          </form>
        </div>

        <!-- ✅ Product Info -->
        <h3><?= $row['name']; ?></h3>
        <p class="price">₹<?= $row['price']; ?></p>

        <div class="card-actions">
          <!-- Add to Cart -->
          <form action="../add_to_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?= $row['id']; ?>" />
            <input type="hidden" name="product_name" value="<?= $row['name']; ?>" />
            <input type="hidden" name="product_price" value="<?= $row['price']; ?>" />
            <button type="submit" class="cart-btn">
              <i class="fa-solid fa-cart-shopping"></i> Add to Cart
            </button>
          </form>
          
          <!-- Rating -->
          <div class="rating"><span><?= $row['rating']; ?> ★</span></div>
        </div>
      </div>
      
    <?php endwhile; ?>
  </div>
</section>


<section id="vacation" class="product-section">   
  <h2 class="occasion-title">Vacation Wardrobe</h2>
  <div class="product-grid">
    <?php 
    // ✅ use category instead of occasion
    $vacationProducts = $conn->query("SELECT * FROM products WHERE category='Vacation' LIMIT 8");
    while ($row = $vacationProducts->fetch_assoc()): ?>
      
      <div class="product-card">
        <div class="image-wrapper">
          <!-- ❌ Removed Offer Badge -->

          <img
            src="../<?= $row['image']; ?>"
            alt="<?= $row['name']; ?>"
            class="product-img"
          />

          <!-- ✅ Wishlist Button -->
          <form method="POST" action="../wishlist.php" class="wishlist-form">
            <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
            <input type="hidden" name="product_name" value="<?= $row['name']; ?>">
            <button type="submit" class="wishlist-btn">
              <i class="fa-regular fa-bookmark product-bookmark"></i>
            </button>
          </form>
        </div>

        <!-- ✅ Product Info -->
        <h3><?= $row['name']; ?></h3>
        <p class="price">₹<?= $row['price']; ?></p>

        <div class="card-actions">
          <!-- Add to Cart -->
          <form action="../add_to_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?= $row['id']; ?>" />
            <input type="hidden" name="product_name" value="<?= $row['name']; ?>" />
            <input type="hidden" name="product_price" value="<?= $row['price']; ?>" />
            <button type="submit" class="cart-btn">
              <i class="fa-solid fa-cart-shopping"></i> Add to Cart
            </button>
          </form>
          
          <!-- Rating -->
          <div class="rating"><span><?= $row['rating']; ?> ★</span></div>
        </div>
      </div>
      
    <?php endwhile; ?>
  </div>
</section>


<section id="party" class="product-section">   
  <h2 class="occasion-title">Party Perfect</h2>
  <div class="product-grid">
    <?php 
    // ✅ use category instead of occasion
    $partyProducts = $conn->query("SELECT * FROM products WHERE category='Party' LIMIT 8");
    while ($row = $partyProducts->fetch_assoc()): ?>
      
      <div class="product-card">
        <div class="image-wrapper">
          <!-- ❌ Removed Offer Badge -->

          <img
            src="../<?= $row['image']; ?>"
            alt="<?= $row['name']; ?>"
            class="product-img"
          />

          <!-- ✅ Wishlist Button -->
          <form method="POST" action="../wishlist.php" class="wishlist-form">
            <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
            <input type="hidden" name="product_name" value="<?= $row['name']; ?>">
            <button type="submit" class="wishlist-btn">
              <i class="fa-regular fa-bookmark product-bookmark"></i>
            </button>
          </form>
        </div>

        <!-- ✅ Product Info -->
        <h3><?= $row['name']; ?></h3>
        <p class="price">₹<?= $row['price']; ?></p>

        <div class="card-actions">
          <!-- Add to Cart -->
          <form action="../add_to_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?= $row['id']; ?>" />
            <input type="hidden" name="product_name" value="<?= $row['name']; ?>" />
            <input type="hidden" name="product_price" value="<?= $row['price']; ?>" />
            <button type="submit" class="cart-btn">
              <i class="fa-solid fa-cart-shopping"></i> Add to Cart
            </button>
          </form>
          
          <!-- Rating -->
          <div class="rating"><span><?= $row['rating']; ?> ★</span></div>
        </div>
      </div>
      
    <?php endwhile; ?>
  </div>
</section>


<section id="winter" class="product-section">   
  <h2 class="occasion-title">Winter Warmth</h2>
  <div class="product-grid">
    <?php 
    // ✅ use category instead of occasion
    $winterProducts = $conn->query("SELECT * FROM products WHERE category='Winter' LIMIT 8");
    while ($row = $winterProducts->fetch_assoc()): ?>
      
      <div class="product-card">
        <div class="image-wrapper">
          <!-- ❌ Removed Offer Badge -->

          <img
            src="../<?= $row['image']; ?>"
            alt="<?= $row['name']; ?>"
            class="product-img"
          />

          <!-- ✅ Wishlist Button -->
          <form method="POST" action="../wishlist.php" class="wishlist-form">
            <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
            <input type="hidden" name="product_name" value="<?= $row['name']; ?>">
            <button type="submit" class="wishlist-btn">
              <i class="fa-regular fa-bookmark product-bookmark"></i>
            </button>
          </form>
        </div>

        <!-- ✅ Product Info -->
        <h3><?= $row['name']; ?></h3>
        <p class="price">₹<?= $row['price']; ?></p>

        <div class="card-actions">
          <!-- Add to Cart -->
          <form action="../add_to_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?= $row['id']; ?>" />
            <input type="hidden" name="product_name" value="<?= $row['name']; ?>" />
            <input type="hidden" name="product_price" value="<?= $row['price']; ?>" />
            <button type="submit" class="cart-btn">
              <i class="fa-solid fa-cart-shopping"></i> Add to Cart
            </button>
          </form>
          
          <!-- Rating -->
          <div class="rating"><span><?= $row['rating']; ?> ★</span></div>
        </div>
      </div>
      
    <?php endwhile; ?>
  </div>
</section>


    <!-- Image Modal -->
    <div class="image-modal" id="imageModal">
      <div class="modal-content">
        <div class="modal-image-wrapper">
          <span class="modal-close" id="modalClose">&times;</span>
          <img id="modalImg" src="" />
        </div>
      </div>
    </div>

    <script>
      // Toggle Add to Cart
      document.querySelectorAll(".cart-btn").forEach((btn) => {
        btn.addEventListener("click", () => {
          btn.classList.toggle("active");
        });
      });

      // Toggle Bookmark
      document.querySelectorAll(".product-bookmark").forEach((icon) => {
        icon.addEventListener("click", () => {
          icon.classList.toggle("active");
          icon.classList.toggle("fa-regular");
          icon.classList.toggle("fa-solid");
        });
      });

      // Image Modal
      const modal = document.getElementById("imageModal");
      const modalImg = document.getElementById("modalImg");
      const closeBtn = document.getElementById("modalClose");

      document.querySelectorAll(".product-img").forEach((img) => {
        img.addEventListener("click", () => {
          modal.style.display = "flex";
          modalImg.src = img.src;
        });
      });

      closeBtn.addEventListener("click", () => {
        modal.style.display = "none";
      });

      window.addEventListener("click", (e) => {
        if (e.target === modal) {
          modal.style.display = "none";
        }
      });
    </script>
  </body>
</html>