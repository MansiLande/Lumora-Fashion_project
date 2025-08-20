<?php
session_start(); // keep this always
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Our Designers</title>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    />

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
      /* === Card Dropdown === */
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

      .profile-section {
        padding: 60px 20px;
        margin-top: 110px;
      }
      .profile-img {
        width: 350px; /* fixed width */
        height: 450px; /* fixed height */
        object-fit: cover; /* crop image neatly */
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(245, 213, 128, 0.3);
        display: block;
        margin: 0 auto; /* center the image */
      }

      h2 {
        color: gold;
        font-size: 2.5rem;
        margin-bottom: 20px; /* reduced from 120px */
      }
      p {
        line-height: 1.7;
        font-size: 1.5rem;
        color: #ddd;
      }
      .btn-appointment {
        margin-top: 20px;
        background-color: #f5d580;
        color: #111;
        border-radius: 25px;
        padding: 12px 28px;
        text-decoration: none;
        display: inline-block;
        font-weight: 600;
        transition: all 0.3s;
      }
      .btn-appointment:hover {
        background-color: #d9b44a;
        color: #000;
      }
      .collection-preview {
        padding: 40px 20px;
        background: #111;
        margin-top: 30px;
        border-radius: 10px;
      }
      .collection-preview img {
        width: 100%; /* Makes it responsive */
        max-width: 350px; /* Same width for all */
        height: 450px; /* Fixed height */
        object-fit: cover; /* Crops without distortion */
        border-radius: 12px;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        border: 1px solid #333;
        display: block;
        margin-left: auto;
        margin-right: auto;
      }
      .designer-block {
        margin-bottom: 80px;
        border-bottom: 1px solid #222;
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
            <p class="user-email">
              <?= htmlspecialchars($_SESSION['email']); ?>
            </p>
            <a href="logout.php" class="logout-btn">Logout</a>
          </div>
        </div>
        <?php else: ?>
        <a href="signin-signup.php" class="signin">SIGN IN</a>
        <?php endif; ?>
        <script>
          function toggleProfileCard() {
            const card = document.getElementById("profileCard");
            card.style.display =
              card.style.display === "block" ? "none" : "block";
          }

          // Close when clicking outside
          document.addEventListener("click", function (e) {
            const dropdown = document.querySelector(".profile-dropdown");
            if (!dropdown.contains(e.target)) {
              document.getElementById("profileCard").style.display = "none";
            }
          });
        </script>
      </div>
    </header>

    <!-- Designer 1 -->
   <section id="designer-aurora" class="designer-block">
      <section class="profile-section container">
        <div class="row align-items-center">
          <div class="col-md-5 text-center">
            <img src="designer1.jpg" alt="Aurora Vélour" class="profile-img" />
          </div>
          <div class="col-md-7">
            <h2>Aurora Vélour</h2>
            <p>
              Aurora Vélour is a trailblazing fashion designer celebrated for
              her bold use of textures, intricate detailing, and fearless
              creativity. Emerging from Parisian ateliers, she has redefined
              luxury fashion by merging classic haute couture techniques with
              modern artistry.
            </p>
            <p>
              Known for her ethereal gowns and avant-garde silhouettes, Aurora’s
              work often explores themes of femininity, empowerment, and
              cultural fusion. Her collections have graced international runways
              and attracted a global clientele who admire her vision of
              timeless, yet modern, couture.
            </p>

            <a href="../index.php#book-appointment" class="btn-appointment"
              >Book Appointment</a
            >
          </div>
        </div>
        </div>
      </section>
    </section>

    <!-- Designer 2 -->
   <section id="designer-celeste" class="designer-block">
      <section class="profile-section container">
        <div class="row align-items-center">
          <div class="col-md-5 text-center">
            <img
              src="designer2.jpg"
              alt="Celeste Marlowe"
              class="profile-img"
            />
          </div>
          <div class="col-md-7">
            <h2>Celeste Marlowe</h2>
            <p>
              Celeste Marlowe is a British fashion designer admired for her
              romantic yet modern style. Inspired by literature, art, and
              nature, she blends flowing fabrics, soft tones, and delicate
              embroidery to create pieces that feel timeless and graceful.
            </p>
            <p>
              Her collections often tell stories through fashion, drawing on
              themes of romance, elegance, and natural beauty. Celebrities and
              style icons frequently choose her gowns for red carpets and
              special occasions, as her designs strike a balance between classic
              sophistication and contemporary trends.
            </p>
            <a href="../index.php#book-appointment" class="btn-appointment"
              >Book Appointment</a
            >
          </div>
        </div>
        
        </div>
      </section>
    </section>

    <!-- Designer 3 -->
   <section id="designer-liora" class="designer-block">
      <section class="profile-section container">
        <div class="row align-items-center">
          <div class="col-md-5 text-center">
            <img src="designer3.jpg" alt="Liora Beaumont" class="profile-img" />
          </div>
          <div class="col-md-7">
            <h2>Liora Beaumont</h2>
            <p>
              Liora Beaumont is a visionary fashion designer celebrated for his
              sculptural silhouettes and modern elegance. Rising from the
              fashion hubs of Milan, he has earned recognition for blending
              architectural precision with fluid fabrics, producing designs that
              are both bold and wearable.
            </p>
            <p>
              His collections often emphasize strength, individuality, and
              artistic expression, making his creations a top choice for
              trendsetters who seek confidence and originality in their style.
              Liora’s work is praised for transforming classic tailoring into
              contemporary statements that command attention and respect.
            </p>
            <a href="../index.php#book-appointment" class="btn-appointment"
              >Book Appointment</a
            >
          </div>
        </div>
       
          </div>
        </div>
      </section>
    </section>

    <!-- Designer 4 -->
   <section id="designer-seraphine" class="designer-block">
      <section class="profile-section container">
        <div class="row align-items-center">
          <div class="col-md-5 text-center">
            <img src="designer4.jpg" alt="Liora Beaumont" class="profile-img" />
          </div>
          <div class="col-md-7">
            <h2>Seraphine D’Or</h2>
            <p>
              Seraphine D’Or is a Paris-born designer celebrated for her
              romantic couture and timeless femininity. With a background in
              fine arts and luxury fashion, she crafts gowns and ensembles that
              flow with elegance, drawing inspiration from nature, poetry, and
              classic European culture. Her collections are known for delicate
              fabrics, graceful drapery, and intricate detailing that highlight
              confidence and sophistication.
            </p>
            <p>
              Over the years, Seraphine has become a favorite among clients who
              appreciate classic couture with a modern touch. Whether for
              evening wear, bridal couture, or statement red-carpet looks, her
              designs embody luxury, emotion, and refinement, making her a true
              icon of elegance.
            </p>
            <a href="../index.php#book-appointment" class="btn-appointment"
              >Book Appointment</a
            >
          </div>
        </div>
      
        </div>
      </section>
    </section>

    <!-- Designer 5 -->
    <section id="designer-elodie" class="designer-block">
      <section class="profile-section container">
        <div class="row align-items-center">
          <div class="col-md-5 text-center">
            <img src="designer5.jpg" alt="Liora Beaumont" class="profile-img" />
          </div>
          <div class="col-md-7">
            <h2>Élodie Vesper</h2>
            <p>
              Élodie Vesper is a visionary menswear and unisex fashion designer
              known for his bold experimentation with tailoring and
              street-inspired luxury. Originally trained in London, he combines
              structured cuts with urban creativity, creating pieces that stand
              out for their confidence and individuality. His designs are sharp,
              daring, and versatile—perfect for those who want to break away
              from traditional styles.
            </p>
            <p>
              Drawing inspiration from modern architecture, music, and city
              life, Élodie crafts collections that merge high fashion with
              cultural relevance. His work challenges conventions while
              maintaining a sense of elegance, making him a rising name for
              those seeking fashion-forward and fearless expression
            </p>
            <a href="../index.php#book-appointment" class="btn-appointment"
              >Book Appointment</a
            >
          </div>
        </div>
        </div>
      </section>
    </section>

    <!-- Designer 6 -->
    <section id="designer-valencia" class="designer-block">
      <section class="profile-section container">
        <div class="row align-items-center">
          <div class="col-md-5 text-center">
            <img src="designer6.jpg" alt="Liora Beaumont" class="profile-img" />
          </div>
          <div class="col-md-7">
            <h2>Valencia Noire</h2>
            <p>
              Valencia Noire is a designer celebrated for her dramatic style and
              fearless creativity. Her signature collections embrace gothic
              elegance, minimalism, and artistic rebellion, often blending bold
              silhouettes with dark, luxurious palettes. With each creation, she
              pushes the boundaries of conventional fashion, delivering pieces
              that are both mysterious and empowering.
            </p>
            <p>
              Known for her avant-garde designs and intricate craftsmanship,
              Valencia appeals to clients who wish to make strong, unforgettable
              statements. Whether in evening wear or experimental couture, her
              work radiates power, confidence, and individuality—qualities that
              define her place in the global fashion industry.
            </p>
            <a href="../index.php#book-appointment" class="btn-appointment"
              >Book Appointment</a
            >
          </div>
        </div>
        </div>
      </section>
    </section>

    <!-- Repeat same structure for Designer 4, 5, 6 ... -->
  </body>
</html>
