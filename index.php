<?php
session_start(); // keep this always
?>

<?php
include 'db.php'; // your DB connection

$sql = "SELECT * FROM products WHERE category='New Arrival'";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>LUMORA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
  </head>
  <body>
<!-- Nav bar section -->
<header class="main-navbar">
  <div class="nav-left">
    <h1 class="navbar-logo">LUMORA</h1>
    <a href="index.php">Home</a>
    <a href="#new-arrivals">New Arrival</a>
    <a href="#shop-by-category">Category</a>
    <a href="#trending-banner-container">Trendings</a>
    <a href="#occasions">Occasions</a>
    <a href="#designers">Designers</a>
    <a href="#book-appointment">Meet Stylist</a>
    <a href="#about-lumora">About Brand</a>
    <a href="#reviews-section">Reviews</a>
  </div>


      <!-- Right Navbar Icons -->
      <div class="nav-right">
        <!-- Search Bar -->
        <div class="search-bar">
          <i class="fas fa-search nav-icon"></i>
          <input type="text" placeholder="  SEARCH" />
        </div>

        <div class="cart-icon">
          <a href="cart.php">
            <i class="fa-solid fa-cart-shopping"></i>
          </a>
        </div>
        <div class="bookmark-icon">
          <a href="wishlist_view.php">
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


    <!-- Hero Section with Animated Logo -->

    <section class="hero">
      <video autoplay muted loop class="bg-video" id="bgVideo">
        <source src="fashion video.mp4" type="video/mp4" />
        Your browser does not support the video tag.
      </video>

      <div class="overlay"></div>

      <!-- Center Logo Animation -->
      <h1 class="brand-name animate-brand">LUMORA</h1>

      <div class="hero-content">
        <div class="shop-now-container">
          <p class="tagline">Elevate. Empower. Express.</p>
          <a href="#new-arrivals" class="shop-now-btn">Shop Now</a>
        </div>
      </div>
    </section>

    <script>
      window.addEventListener("DOMContentLoaded", () => {
        const brand = document.querySelector(".animate-brand");
        const navLogo = document.querySelector(".navbar-logo");

        // Show navbar logo after animation
        setTimeout(() => {
          brand.style.display = "none";
          navLogo.style.display = "block";
        }, 5000); // match animation duration

        // === VIDEO SWITCHING CODE ===
        const video = document.getElementById("bgVideo");
        const sources = [
          "fashion video.mp4",
          "fashion video1.mp4",
          "fashion video3.mp4",
          "fashion video4.mp4",
          "fashion video5.mp4",
        ];
        let index = 0;

        setInterval(() => {
          index = (index + 1) % sources.length;
          video.querySelector("source").src = sources[index];
          video.load();
          video.play();
        }, 10000); // change every 10 seconds
      });
    </script>

 <!-- New Arrivals Section -->
<section id="new-arrivals">
  <div class="new-arrivals-container">
    <h2 class="new-arrivals-heading">
      <a href="#new-arrivals">New Arrivals</a>
    </h2>

    <ul class="new-arrivals-list">
      <?php 
      if ($result->num_rows > 0) {
          $i = 1;
          while ($row = $result->fetch_assoc()) { ?>
            <li class="new-arrivals-item item-<?php echo $i; ?>">
              <span class="offer-badge"><?php echo $row['offer']; ?></span>
              <span class="arrival-name"><?php echo $row['name']; ?></span>
              <span class="arrival-price">Price: $<?php echo $row['price']; ?></span>
              <div class="action-buttons">
                <form method="POST" action="add_to_cart.php">
  <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
  <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
  <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
  
  <button type="submit" class="add-to-cart-btn">
    <i class="fa-solid fa-cart-shopping"></i> Add to Cart
  </button>
</form>

                <form method="POST" action="wishlist.php" class="wishlist-form">
  <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
  <button type="submit" class="bookmark-btn">
    <i class="fa-regular fa-bookmark bookmark-icon-cards"></i>
  </button>
</form>

              </div>
            </li>
      <?php 
            $i++;
          }
      } else {
          echo "<p>No new arrivals found.</p>";
      }
      ?>
    </ul>
  </div>
</section>
    <script>
      /* Bookmark toggle */
      document.querySelectorAll(".bookmark-icon-cards").forEach((icon) => {
        icon.addEventListener("click", () => {
          icon.classList.toggle("fa-regular");
          icon.classList.toggle("fa-solid");
          icon.style.color = "white";
        });
      });

      /* Add to Cart toggle */
      document.querySelectorAll(".add-to-cart-btn").forEach((button) => {
        button.addEventListener("click", () => {
          button.classList.toggle("added"); // toggles white background & black text
        });
      });
    </script>

    <!-- shop by category section-->

    <!-- shop by category section-->
    <section id="shop-by-category" class="shop-by-category">
      <h2 class="category-heading">Shop by Category</h2>
      <a href="all-categories.html" class="view-all-link"
        >View All Categories</a
      >

      <!-- Carousel wrapper -->
      <div class="carousel-container">
        <!-- Left Arrow -->
        <button class="carousel-arrow left-arrow">&#10094;</button>

        <div class="category-list">
          <div class="category-item">
            <a href="categories/category casualtops.php">
              <img src="categories/category-images/img1.jpg" alt="Dresses" />
              <p>Casual Tops</p>
            </a>
          </div>
          <div class="category-item">
            <a href="categories/category formalwear.php">
              <img src="categories/category-images/img2.jpg" alt="HandBags" />
              <p>FormalWear</p>
            </a>
          </div>
          <div class="category-item">
            <a href="categories/category dresses.php">
              <img src="categories/category-images/img3.jpg" alt="FootWear" />
              <p>Dresses</p>
            </a>
          </div>
          <div class="category-item">
            <a href="categories/category handbags.php">
              <img
                src="categories/category-images/img4.jpg"
                alt="Accessories"
              />
              <p>HandBags</p>
            </a>
          </div>
          <div class="category-item">
            <a href="categories/category footwear.php">
              <img src="categories/category-images/img5.jpg" alt="Bottoms" />
              <p>FootWear</p>
            </a>
          </div>
          <div class="category-item">
            <a href="categories/category accessories.php">
              <img src="categories/category-images/img6.jpg" alt="Sunglasses" />
              <p>Accessories</p>
            </a>
          </div>
          <div class="category-item">
            <a href="categories/category denim.php">
              <img src="categories/category-images/img7.jpg" alt="Denim Wear" />
              <p>Denim Wear</p>
            </a>
          </div>
          <div class="category-item">
            <a href="categories/category bottomwear.php">
              <img src="categories/category-images/img8.jpg" alt="Denim Wear" />
              <p>BottomWear</p>
            </a>
          </div>
        </div>

        <!-- Right Arrow -->
        <button class="carousel-arrow right-arrow">&#10095;</button>
      </div>
    </section>

    <script>
      const categoryList = document.querySelector(".category-list");
      const leftArrow = document.querySelector(".left-arrow");
      const rightArrow = document.querySelector(".right-arrow");

      leftArrow.addEventListener("click", () => {
        categoryList.scrollBy({ left: -300, behavior: "smooth" });
      });

      rightArrow.addEventListener("click", () => {
        categoryList.scrollBy({ left: 300, behavior: "smooth" });
      });
    </script>

    <div id="trending-banner-container" class="trending-banner-container">
  <section class="explore-trending-banner">
    <h2 class="explore-trending-title">Explore Trendings</h2>

    <div class="trending-banner-wrapper">
      <!-- Left Side Text -->
      <div class="trending-banner-text">
        <h3 class="trend-alert">Trend Alert!</h3>
        <p class="trend-tagline">
          <span class="small-text">up to</span>
          <span class="big-text">75%</span>
          <span class="small-text">off</span>
        </p>
        <p class="trend-subtitle">
          From sleek blazers to cozy hoodies and effortlessly chic jumpsuits
          – your season's statement pieces are here.
        </p>
      </div>

          <!-- Right Side Images -->
          <div class="trending-banner-images">
            <div class="trending-image-card">
              <a href="categories/category formalwear.php">
                <img src="trending images/blazer.png" alt="Jumpsuits" />
              </a>
              <p>Blazers</p>
            </div>
            <div class="trending-image-card">
              <a href="categories/category denim.php">
                <img src="trending images/denim.png" alt="Blazers" />
              </a>
              <p>Denim Fit</p>
            </div>
            <div class="trending-image-card">
              <a href="categories/category dresses.php">
                <img src="trending images/jumpsuit.png" alt="Hoodies" />
              </a>
              <p>Jumpsuits</p>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Shop by occasssion section -->

    <section id="occasions">
      <div class="occasions-container">
        <h2 class="occasions-heading">
          <a href="ocassionimages/ocassion.php">Shop by Occasions</a>
        </h2>
        <p class="occasions-tagline">
          <a href="ocassionimages/ocassion.php">"Attire for Life’s Finest Moments"</a>
        </p>

        <div class="occasion-banners">
          <!-- Banner 1 -->
          <div class="banner">
            <div class="swiper banner-slider slider1">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <img
                    src="ocassionimages/sale-banner1-img/img1.jpg"
                    alt="img1"
                  />
                </div>
                <div class="swiper-slide">
                  <img
                    src="ocassionimages/sale-banner1-img/img2.jpg"
                    alt="img2"
                  />
                </div>
                <div class="swiper-slide">
                  <img
                    src="ocassionimages/sale-banner1-img/img3.jpg"
                    alt="img3"
                  />
                </div>
                <div class="swiper-slide">
                  <img
                    src="ocassionimages/sale-banner1-img/img4.jpg"
                    alt="img4"
                  />
                </div>
                <div class="swiper-slide">
                  <img
                    src="ocassionimages/sale-banner1-img/img5.jpg"
                    alt="img5"
                  />
                </div>
              </div>
            </div>
            <div class="banner-top">
              <h3>Up to 50% Off</h3>
              <p>Ends in <span id="timer1"></span></p>
            </div>
            <div class="banner-bottom">
              <h4><i>Vacation Deals You Can't Miss</i></h4>
              <a href="ocassionimages/ocassion.php#vacation" class="shop-btn">Shop Now</a>
            </div>
          </div>

          <!-- Banner 2 -->
          <div class="banner">
            <div class="swiper banner-slider slider2">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <img
                    src="ocassionimages/sale-banner2-img/img1.jpg"
                    alt="img1"
                  />
                </div>
                <div class="swiper-slide">
                  <img
                    src="ocassionimages/sale-banner2-img/img2.jpg"
                    alt="img2"
                  />
                </div>
                <div class="swiper-slide">
                  <img
                    src="ocassionimages/sale-banner2-img/img3.jpg"
                    alt="img3"
                  />
                </div>
                <div class="swiper-slide">
                  <img
                    src="ocassionimages/sale-banner2-img/img4.jpg"
                    alt="img4"
                  />
                </div>
                <div class="swiper-slide">
                  <img
                    src="ocassionimages/sale-banner2-img/img5.jpg"
                    alt="img5"
                  />
                </div>
              </div>
            </div>
            <div class="banner-top">
              <h3>Flat 30% Off</h3>
              <p>Ends in <span id="timer2"></span></p>
            </div>
            <div class="banner-bottom">
              <h4><i>Winter Wonderland Sale</i></h4>
              <a href="ocassionimages/ocassion.php#winter" class="shop-btn">Shop Now</a>
            </div>
          </div>
        </div>

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        <script>
          document.addEventListener("DOMContentLoaded", function () {
            // Sliders
            new Swiper(".slider1", {
              loop: true,
              autoplay: { delay: 3000, disableOnInteraction: false },
              effect: "slide",
            });

            new Swiper(".slider2", {
              loop: true,
              autoplay: { delay: 3000, disableOnInteraction: false },
              effect: "slide",
            });

            // Countdown
            function startCountdown(duration, displayId) {
              let timer = duration;
              setInterval(() => {
                let hours = String(Math.floor(timer / 3600)).padStart(2, "0");
                let minutes = String(Math.floor((timer % 3600) / 60)).padStart(
                  2,
                  "0"
                );
                let seconds = String(timer % 60).padStart(2, "0");
                document.getElementById(
                  displayId
                ).textContent = `${hours}:${minutes}:${seconds}`;
                if (--timer < 0) timer = duration;
              }, 1000);
            }

            startCountdown(3 * 60 * 60, "timer1");
            startCountdown(3 * 60 * 60, "timer2");
          });
        </script>

        <!-- ocassion cards-->

        <p class="occasions-tagline-2nd">Dive into curated occasions</p>
        <ul class="occasions-list">
          <li>
            <div class="occasions-item">
              <span class="occasion-name">Wedding Edit</span>
            </div>
            <a href="ocassionimages/ocassion.php#wedding" class="explore-link">Explore Collection</a>
          </li>

          <li>
            <div class="occasions-item">
              <span class="occasion-name">Summer Vibes</span>
            </div>
            <a href="ocassionimages/ocassion.php#summer" class="explore-link">Explore Collection</a>
          </li>

          <li>
            <div class="occasions-item">
              <span class="occasion-name">Runway Looks</span>
            </div>
            <a href="ocassionimages/ocassion.php#runway" class="explore-link">Explore Collection</a>
          </li>

          <li>
            <div class="occasions-item">
              <span class="occasion-name">Vacation Wardboard</span>
            </div>
            <a href="ocassionimages/ocassion.php#vacation" class="explore-link">Explore Collection</a>
          </li>

          <li>
            <div class="occasions-item">
              <span class="occasion-name">Party Perfect</span>
            </div>
            <a href="ocassionimages/ocassion.php#party" class="explore-link">Explore Collection</a>
          </li>

          <li>
            <div class="occasions-item">
              <span class="occasion-name">Winter Warmth</span>
            </div>
            <a href="ocassionimages/ocassion.php#winter" class="explore-link">Explore Collection</a>
          </li>
        </ul>
      </div>
    </section>

    <!-- shop by designers section -->

    <section id="designers">
      <div class="designers-container">
        <h2 class="designers-heading">
          <a href="#designerimages/designers_detail.php">Shop by Designers</a>
        </h2>
        <p class="designers-tagline">
          <a href="designerimages/designers_detail.php">"Crafted by Icons, Worn by You"</a>
        </p>

        <ul class="designers-list">
          <li class="designers-item">
            <a
              href="designer1.html"
              class="designer-image"
              style="background-image: url('designerimages/designer1.jpg')"
            ></a>

            <h3 class="designer-name">
              <a href="designer1.html">Aurora Vélour</a>
            </h3>

            <div class="designer-buttons">
              <a href="designerimages/designers_detail.php#designer-aurora" class="btn">Browse Collection</a>
            </div>
          </li>

          <li class="designers-item">
            <a
              href="designer2.html"
              class="designer-image"
              style="background-image: url('designerimages/designer2.jpg')"
            ></a>

            <h3 class="designer-name">
              <a href="designer2.html">Celeste Marlowe</a>
            </h3>

            <div class="designer-buttons">
              <a href="designerimages/designers_detail.php#designer-celeste" class="btn">Browse Collection</a>
            </div>
          </li>

          <li class="designers-item">
            <a
              href="designer3.html"
              class="designer-image"
              style="background-image: url('designerimages/designer3.jpg')"
            ></a>

            <h3 class="designer-name">
              <a href="designer3.html">Liora Beaumont</a>
            </h3>

            <div class="designer-buttons">
              <a href="designerimages/designers_detail.php#designer-liora" class="btn">Browse Collection</a>
            </div>
          </li>

          <li class="designers-item">
            <a
              href="designer4.html"
              class="designer-image"
              style="background-image: url('designerimages/designer4.jpg')"
            ></a>

            <h3 class="designer-name">
              <a href="designer4.html">Seraphine D’Or</a>
            </h3>

            <div class="designer-buttons">
              <a href="designerimages/designers_detail.php#designer-seraphine" class="btn">Browse Collection</a>
            </div>
          </li>

          <li class="designers-item">
            <a
              href="designer5.html"
              class="designer-image"
              style="background-image: url('designerimages/designer5.jpg')"
            ></a>

            <h3 class="designer-name">
              <a href="designer5.html">Élodie Vesper</a>
            </h3>

            <div class="designer-buttons">
              <a href="designerimages/designers_detail.php#designer-elodie" class="btn">Browse Collection</a>
            </div>
          </li>

          <li class="designers-item">
            <a
              href="designer6.html"
              class="designer-image"
              style="background-image: url('designerimages/designer6.jpg')"
            ></a>

            <h3 class="designer-name">
              <a href="designer6.html">Valencia Noire</a>
            </h3>

            <div class="designer-buttons">
              <a href="designerimages/designers_detail.php#designer-valencia" class="btn">Browse Collection</a>
            </div>
          </li>
        </ul>
      </div>
    </section>

    <!--book appointment section-->

  <section id="book-appointment" class="luxury-booking"> 
  <!-- Title -->
  <h2 class="luxury-title">Book Your LUMORA Experience</h2>
  <p class="tagline">
    Meet your designer, discover your look, and create something truly yours.
  </p>

  <div class="booking-container">
    <div class="designer-preview hidden">
      <img id="designer-img" src="" alt="Selected Designer" />
      <div class="designer-name" id="designer-name"></div>
    </div>

    <!-- Booking Form -->
    <form class="booking-form" method="POST" action="save_appointment.php">
      <!-- Hidden field to store designer name -->
      <input type="hidden" name="designer_name" id="designer-name-hidden" />
      <input type="hidden" name="designer_image" id="designer-image-hidden" />

      <div class="form-group" style="margin-bottom: 40px">
        <label>Select Designer</label>
        <select id="designer-select" required>
          <option value="" disabled selected>— Select Your Designer —</option>
          <option value="designerimages/designer1.jpg" data-name="Aurora Vélour">Aurora Vélour</option>
          <option value="designerimages/designer2.jpg" data-name="Celeste Marlowe">Celeste Marlowe</option>
          <option value="designerimages/designer3.jpg" data-name="Liora Beaumont">Liora Beaumont</option>
          <option value="designerimages/designer4.jpg" data-name="Seraphine D’Or">Seraphine D’Or</option>
          <option value="designerimages/designer5.jpg" data-name="Élodie Vesper">Élodie Vesper</option>
          <option value="designerimages/designer6.jpg" data-name="Valencia Noire">Valencia Noire</option>
        </select>
      </div>

      <div class="form-group">
        <label>Appointment Type</label>
        <select name="appointment_type" required>
          <option>In-person Styling</option>
          <option>Virtual Consultation</option>
          <option>Custom Garment Fitting</option>
        </select>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Date</label>
          <input type="date" name="appointment_date" required />
        </div>
        <div class="form-group">
          <label>Time</label>
          <input type="time" name="appointment_time" required />
        </div>
      </div>

      <div class="form-group">
        <label>Your Name</label>
        <input type="text" name="customer_name" placeholder="Full Name" required />
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" placeholder="you@example.com" required />
        </div>
        <div class="form-group">
          <label>Phone</label>
          <input type="tel" name="phone" placeholder="+91 98765 43210" required />
        </div>
      </div>

      <div class="form-group">
        <label>Special Requests</label>
        <textarea name="special_requests" placeholder="Preferred style, inspiration, or size"></textarea>
      </div>

      <button type="submit" class="luxury-btn">Reserve Appointment</button>
    </form>
  </div>
</section>

<script>
  const bookingContainer = document.querySelector(".booking-container");
  const designerSelect = document.getElementById("designer-select");
  const designerImg = document.getElementById("designer-img");
  const designerName = document.getElementById("designer-name");

  designerSelect.addEventListener("change", function () {
    const selectedOption = this.options[this.selectedIndex];

    // Update preview image & name
    designerImg.src = selectedOption.value;
    designerName.textContent = selectedOption.dataset.name;

    // Save to hidden input (for form submit)
    document.getElementById("designer-name-hidden").value = selectedOption.dataset.name;

    // Activate animation
    bookingContainer.classList.add("active");
  });



  designerSelect.addEventListener("change", function () {
  const selectedOption = this.options[this.selectedIndex];

  // Update preview
  designerImg.src = selectedOption.value;
  designerName.textContent = selectedOption.dataset.name;

  // Save to hidden inputs
  document.getElementById("designer-name-hidden").value = selectedOption.dataset.name;
  document.getElementById("designer-image-hidden").value = selectedOption.value;

  // Activate animation
  bookingContainer.classList.add("active");
});

</script>


    <!-- ===== About LUMORA Section ===== -->
    <section id="about-lumora">
      <div class="about-hero">
        <h1>
          About
          <span style="font-size: 2rem; letter-spacing: 1px"> LUMORA</span>
        </h1>
        <p class="tagline" style="color: white">
          Where elegance meets timeless craftsmanship
        </p>
      </div>

      <!-- Brand Story -->
      <div class="brand-story">
        <div class="story-text">
          <h2>Threads of Elegance</h2>
          <p style="text-align: justify">
            Founded on the belief that fashion should be both elegant and
            personal, LUMORA brings you handpicked creations from over 1500
            world-class designers. Every piece tells a story, blending artistry
            with modern sophistication.<br /><br />

            From the intricate handwork of seasoned artisans to the innovative
            visions of emerging talent, each design in our collection reflects a
            dedication to detail and a passion for timeless beauty.<br /><br />

            We celebrate individuality, offering styles that empower you to
            express your true self—whether it’s through the subtle grace of
            minimalism or the bold statement of couture.<br /><br />

            With a global reach yet a deeply personal touch, LUMORA transforms
            fashion into an intimate journey, connecting you with pieces that
            resonate, inspire, and endure.
          </p>
        </div>
        <div class="story-video">
          <video autoplay muted loop playsinline>
            <source src="about_brand_video1.mp4" type="video/mp4" />
            Your browser does not support the video tag.
          </video>
        </div>
      </div>

      <!-- Stats Section -->
      <div class="about-stats">
        <div class="stat">
          <i class="fa-solid fa-box"></i>
          <h3>5M+</h3>
          <p>Successful Deliveries</p>
        </div>
        <div class="stat">
          <i class="fa-solid fa-user-tie"></i>
          <h3>1500+</h3>
          <p>Designers</p>
        </div>
        <div class="stat">
          <i class="fa-solid fa-headset"></i>
          <h3>24/7</h3>
          <p>Customer Support</p>
        </div>
        <div class="stat">
          <i class="fa-solid fa-globe"></i>
          <h3>75+</h3>
          <p>Countries Served</p>
        </div>
      </div>

      <!-- Craftsmanship -->
      <div class="craftsmanship">
        <h2>Craftsmanship & Commitment</h2>
        <p>
          At LUMORA, we believe every detail matters. From the precision of
          stitching to the choice of fabric, our designers pour their passion
          into every piece. This dedication ensures that what you wear is not
          just fashion, but a legacy.
        </p>
      </div>
    </section>

    <!-- Reviews section-->

    <section id="reviews-section" class="reviews-section">
      <h2 class="reviews-heading">What Our Customers Say!</h2>

      <!-- Review Form -->
      <form class="review-form" id="reviewForm" action="save_review.php" method="POST">
  <input type="text" name="name" placeholder="Your Name" required />
  <textarea name="review" placeholder="Share your experience..." required></textarea>

  <!-- Star rating -->
  <div class="rating-stars">
    <span>Rate:</span>
    <div class="stars">
      <span data-value="1">★</span>
      <span data-value="2">★</span>
      <span data-value="3">★</span>
      <span data-value="4">★</span>
      <span data-value="5">★</span>
    </div>
    <input type="hidden" name="rating" required />
  </div>

  <button type="submit" class="submit-btn">Submit Review</button>
</form>


      <!-- Reviews Grid -->
     <div class="reviews-container" id="reviewsContainer">
  <?php
  include 'db.php';
  $result = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC LIMIT 5");

  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<div class='review-card'>";
          echo "<h4>" . htmlspecialchars($row['name']) . "</h4>";

          // show stars
          echo "<div class='stars-display'>";
          for ($i = 1; $i <= 5; $i++) {
              echo ($i <= $row['rating']) ? "⭐" : "☆";
          }
          echo "</div>";

          echo "<p>\"" . htmlspecialchars($row['review']) . "\"</p>";
          echo "</div>";
      }
  } else {
      echo "<p>No reviews yet. Be the first to share!</p>";
  }
  ?>
</div>

      <div class="see-more">
        <button id="seeMoreBtn">See More Reviews</button>
      </div>
    </section>
    <script>
      document.addEventListener("DOMContentLoaded", () => {
        const stars = document.querySelectorAll(".stars span");
        const ratingInput = document.querySelector("input[name='rating']");

        stars.forEach((star) => {
          star.addEventListener("click", () => {
            const value = parseInt(star.getAttribute("data-value"));
            ratingInput.value = value;

            stars.forEach((s, i) => {
              s.classList.toggle("filled", i < value);
            });
          });
        });
      });
    </script>

    <!--Footer section-->

    <footer class="luxury-footer">
      <div class="footer-container">
        <!-- Brand Info -->
        <div class="footer-column">
          <h3 class="footer-logo">LUMORA</h3>
          <p>
            Where couture meets artistry. At LUMORA, we craft timeless designs
            that embody grace, sophistication, and individuality.
          </p>
        </div>

        <!-- Quick Links -->
        <div class="footer-column">
          <h4>Explore</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Our Story</a></li>
            <li><a href="#">Collections</a></li>
            <li><a href="#">Book Appointment</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>

        <!-- Customer Service -->
        <div class="footer-column">
          <h4>Customer Care</h4>
          <ul>
            <li><a href="#">FAQs</a></li>
            <li><a href="#">Shipping & Returns</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms & Conditions</a></li>
          </ul>
        </div>

        <!-- Social Media -->
        <div class="footer-column">
          <h4>Follow LUMORA On</h4>
          <div class="social-icons">
            <a href="https://instagram.com/yourpage" target="_blank"
              ><i class="fab fa-instagram"></i
            ></a>
            <a href="https://facebook.com/yourpage" target="_blank"
              ><i class="fab fa-facebook-f"></i
            ></a>
            <a href="https://twitter.com/yourpage" target="_blank"
              ><i class="fab fa-twitter"></i
            ></a>
            <a href="https://pinterest.com/yourpage" target="_blank"
              ><i class="fab fa-pinterest"></i
            ></a>
            <a href="https://youtube.com/yourpage" target="_blank"
              ><i class="fab fa-youtube"></i
            ></a>
          </div>
          <p class="follow-text">Join our world of elegance & creativity.</p>
        </div>
      </div>

      <div class="footer-bottom">
        <p>© 2025 LUMORA. All Rights Reserved</p>
      </div>
    </footer>


  <!-- Place this before </body> -->
<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  intent="WELCOME"
  chat-title="LumoraBot"
  agent-id="ea0ecbdb-a432-4ad5-9e1d-1c7953b25b28"
  language-code="en"
></df-messenger>


  </body>
</html>
