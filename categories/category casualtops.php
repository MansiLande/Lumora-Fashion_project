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
    <title>Category | Casual Tops</title>
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

      /* ✅ Side Panel Styles */
      /* ✅ Side Panel Styles */
      .side-panel {
        position: fixed;
        top: 90px; /* below navbar */
        right: 0;
        width: 470px; /* bigger panel */
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        padding: 25px;
        color: white;
        overflow-y: auto;
        z-index: 15;
        border-left: 1px solid #444;
      }

      .side-panel h3 {
        margin-bottom: 18px;
        font-size: 1.5rem;
        font-weight: 700;
        border-bottom: 1px solid #555;
        padding-bottom: 6px;
        text-transform: uppercase;
      }

      /* Each filter block */
      .filter {
        margin-bottom: 18px;
        border-bottom: 1px solid #333;
        padding-bottom: 5px;
      }

      /* Filter title (accordion button) */
      .filter-title {
        width: 100%;
        background: none;
        border: none;
        color: white;
        text-align: left;
        font-size: 1.3rem; /* ✅ bigger font */
        font-weight: 600;
        cursor: pointer;
        padding: 12px 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: color 0.3s ease;
      }

      .filter-title:hover {
        color: gold;
      }

      /* Arrow indicator */
      .filter-title::after {
        content: "˅"; /* Down arrow */
        font-size: 1.2rem;
        transition: transform 0.3s ease;
      }

      .filter.active .filter-title::after {
        content: "˄"; /* Up arrow when open */
        transform: rotate(0deg);
      }

      /* Dropdown hidden by default */
      .filter-options {
        display: none;
        padding: 10px 0 8px 5px;
        font-size: 10rem; /* ✅ bigger font for dropdown items */
        max-height: 240px;
        overflow-y: auto;
      }

      .filter-options label {
        display: block;
        margin-bottom: 8px;
        cursor: pointer;
        color: #ddd;
        font-size: 1.4rem; /* ✅ bigger option font */
      }

      .filter-options label:hover {
        color: gold;
      }

      /* Show active filter dropdown */
      .filter.active .filter-options {
        display: block;
      }

      /* Style checkboxes */
      .filter-options input[type="checkbox"] {
        margin-right: 10px;
        accent-color: gold;
      }

      /* Scrollbar for long lists */
      .filter-options::-webkit-scrollbar {
        width: 6px;
      }

      .filter-options::-webkit-scrollbar-thumb {
        background: #666;
        border-radius: 4px;
      }

      .filter-options::-webkit-scrollbar-thumb:hover {
        background: gold;
      }

      /* Section background */
      .product-section {
        background: #000;
        padding: 30px;
        margin-right: 470px; /* leave space for side panel */
      }

      /* 3 cards side by side */
      .product-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 3 per row */
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
      <a href="#">Category</a> | <a href="#">Casual Tops</a> |
      <a href="#" id="current-category">Corset Tops</a>
    </section>

    <section class="circle-section">
      <div class="circle-container">
        <div class="circle-item selected">
          <a href="#">
            <img
              src="category-images/casualtops-circle-images/corsettop.jpg"
              alt="Tote Bags"
            />
            <span>Corset Top</span>
          </a>
        </div>

        <div class="circle-item selected">
          <a href="#">
            <img
              src="category-images/casualtops-circle-images/haltertop.jpeg"
              alt="Satchel Bag"
            />
            <span>Halter Tops</span>
          </a>
        </div>

        <div class="circle-item selected">
          <a href="#">
            <img
              src="category-images/casualtops-circle-images/peplumtop.jpg"
              alt="Clutch Bag"
            />
            <span>Peplum Tops</span>
          </a>
        </div>

        <div class="circle-item selected">
          <a href="#">
            <img
              src="category-images/casualtops-circle-images/polotshirt.jpg"
              alt="Crossbody Bag"
            />
            <span>Polo TShirts</span>
          </a>
        </div>

        <div class="circle-item selected">
          <a href="#">
            <img
              src="category-images/casualtops-circle-images/tiefronttop.jpg"
              alt="Backpack Bag"
            />
            <span>TieFront Top</span>
          </a>
        </div>
      </div>
    </section>
    <script>
      const categoryText = document.getElementById("current-category");
      const circleItems = document.querySelectorAll(".circle-item");

      circleItems.forEach((item) => {
        item.addEventListener("click", (e) => {
          e.preventDefault(); // stops the link from jumping
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

    <!--side panel-->
    <aside class="side-panel">
      <h3>Filters</h3>

      <!-- Price -->
      <div class="filter">
        <button class="filter-title">Price Range</button>
        <div class="filter-options">
          <label><input type="checkbox" /> Under $50</label>
          <label><input type="checkbox" /> $50 - $100</label>
          <label><input type="checkbox" /> $100 - $200</label>
          <label><input type="checkbox" /> $200 & Above</label>
        </div>
      </div>

      <!-- Size -->
      <div class="filter">
        <button class="filter-title">Size</button>
        <div class="filter-options">
          <label><input type="checkbox" /> S</label>
          <label><input type="checkbox" /> M</label>
          <label><input type="checkbox" /> L</label>
          <label><input type="checkbox" /> XL</label>
        </div>
      </div>

      <!-- Color -->
      <div class="filter">
        <button class="filter-title">Color</button>
        <div class="filter-options">
          <label><input type="checkbox" /> Black</label>
          <label><input type="checkbox" /> White</label>
          <label><input type="checkbox" /> Blue</label>
          <label><input type="checkbox" /> Gray</label>
        </div>
      </div>

      <!-- Fabric -->
      <div class="filter">
        <button class="filter-title">Fabric</button>
        <div class="filter-options">
          <label><input type="checkbox" /> Acrylic</label>
          <label><input type="checkbox" /> Art Silk</label>
          <label><input type="checkbox" /> Banarasi Silk</label>
          <label><input type="checkbox" /> Chanderi Cotton</label>
          <label><input type="checkbox" /> Chanderi Silk</label>
          <label><input type="checkbox" /> Chiffon</label>
          <label><input type="checkbox" /> Cotton</label>
          <label><input type="checkbox" /> Cotton Blend</label>
          <label><input type="checkbox" /> Cotton Cambric</label>
          <label><input type="checkbox" /> Cotton Linen</label>
          <label><input type="checkbox" /> Cotton Lycra</label>
          <label><input type="checkbox" /> Silk</label>
          <label><input type="checkbox" /> Wool</label>
        </div>
      </div>

      <!-- Occasion -->
      <div class="filter">
        <button class="filter-title">Occasion</button>
        <div class="filter-options">
          <label><input type="checkbox" /> Casual</label>
          <label><input type="checkbox" /> Formal</label>
          <label><input type="checkbox" /> Party</label>
          <label><input type="checkbox" /> Wedding</label>
        </div>
      </div>

      <!-- Discounts -->
      <div class="filter">
        <button class="filter-title">Discounts</button>
        <div class="filter-options">
          <label><input type="checkbox" /> 10% or more</label>
          <label><input type="checkbox" /> 20% or more</label>
          <label><input type="checkbox" /> 30% or more</label>
          <label><input type="checkbox" /> 50% or more</label>
        </div>
      </div>

      <!-- Bestsellers -->
      <div class="filter">
        <button class="filter-title">Bestsellers</button>
        <div class="filter-options">
          <label><input type="checkbox" /> Top Rated</label>
          <label><input type="checkbox" /> Most Popular</label>
          <label><input type="checkbox" /> Trending</label>
        </div>
      </div>

      <!-- Rating -->
      <div class="filter">
        <button class="filter-title">Rating</button>
        <div class="filter-options">
          <label><input type="checkbox" /> 4★ & Above</label>
          <label><input type="checkbox" /> 3★ & Above</label>
          <label><input type="checkbox" /> 2★ & Above</label>
        </div>
      </div>

      <!-- Body Type -->
      <div class="filter">
        <button class="filter-title">Body Type</button>
        <div class="filter-options">
          <label><input type="checkbox" /> Regular Fit</label>
          <label><input type="checkbox" /> Slim Fit</label>
          <label><input type="checkbox" /> Plus Size</label>
          <label><input type="checkbox" /> Tall</label>
          <label><input type="checkbox" /> Petite</label>
        </div>
      </div>
    </aside>

    <script>
      // Accordion behavior
      document.querySelectorAll(".filter-title").forEach((btn) => {
        btn.addEventListener("click", () => {
          const parent = btn.parentElement;

          // Close others
          document.querySelectorAll(".filter").forEach((f) => {
            if (f !== parent) f.classList.remove("active");
          });

          // Toggle clicked
          parent.classList.toggle("active");
        });
      });
    </script>


 <section class="product-section">  
    <div class="product-grid">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="product-card">
          <div class="image-wrapper">
  <img
    src="../<?= $row['image']; ?>"
    alt="<?= $row['name']; ?>"
    class="product-img"
  />

  <!-- Wishlist Button -->
  <form method="POST" action="../wishlist.php" class="wishlist-form">
    <input type="hidden" name="product_id" value="<?= $row['id']; ?>">
    <input type="hidden" name="product_name" value="<?= $row['name']; ?>">
    <button type="submit" class="wishlist-btn">
      <i class="fa-regular fa-bookmark product-bookmark"></i>
    </button>
  </form>
</div>

          <h3><?= $row['name']; ?></h3>
          <p class="price">₹<?= $row['price']; ?></p>
          <span class="delivery">Free Delivery</span>

          <div class="card-actions">
            <form action="../add_to_cart.php" method="POST">
              <input type="hidden" name="product_id" value="<?= $row['id']; ?>" />
              <input type="hidden" name="product_name" value="<?= $row['name']; ?>" />
              <input type="hidden" name="product_price" value="<?= $row['price']; ?>" />
              <button type="submit" class="cart-btn">
                <i class="fa-solid fa-cart-shopping"></i> Add to Cart
              </button>
            </form>
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