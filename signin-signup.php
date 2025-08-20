<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LUMORA – Sign In / Sign Up</title>
    <link
      href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap"
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
        font-family: "Playfair Display", serif;
      }
      body {
        background-color: #282828ff;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
      }
      .wrapper {
        width: 1150px;
        height: 680px;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 25px;
        overflow: hidden;
        display: flex;
        backdrop-filter: blur(15px);
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
        border: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
      }
      .form-container {
        width: 50%;
        padding: 70px;
        transition: 0.6s ease;
      }
      .form {
        display: flex;
        flex-direction: column;
        gap: 20px;
      }
      .form h2 {
        color: white;
        font-size: 28px;
        margin-bottom: 20px;
      }
      .form input {
  padding: 18px;
  border-radius: 12px;
  border: none;
  outline: none;
  background: transparent;   /* 👈 fully transparent */
  color: white;
  font-size: 18px;
   caret-color: white; 
}

.form input::placeholder {
  color: rgba(255, 255, 255, 0.7);
}
.form input {
  border: 1px solid rgba(255, 255, 255, 0.4);
}
 .form input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 1000px transparent inset !important;
    -webkit-text-fill-color: white !important;
    background: transparent !important;
    border: 1px solid rgba(255, 255, 255, 0.4);
    transition: background-color 5000s ease-in-out 0s;
  }
      .form button {
        padding: 18px;
        border-radius: 12px;
        border: none;
        font-weight: 600;
        font-size: 18px;
        cursor: pointer;
        background: linear-gradient(135deg, #ffffff);
        color: black;
        transition: 0.3s;
      }
      .form button:hover {
        background: white;
      }
      .google-btn {
        background: white;
        color: black;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        font-weight: 500;
        font-size: 18px;
      }
      .google-btn img {
        width: 20px;
      }
      .side-panel {
        width: 50%;
        background: url("https://images.unsplash.com/photo-1602810314193-01a9f4b38f1f")
          center/cover;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
        padding: 50px;
        position: relative;
      }
      .side-panel::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
      }
      .side-panel-content {
        position: relative;
        z-index: 2;
      }
      .side-panel h3 {
        font-size: 32px;
        margin-bottom: 15px;
      }
      .side-panel p {
        font-size: 16px;
        opacity: 0.85;
        margin-bottom: 25px;
      }
      .side-panel button {
        background: transparent;
        border: 2px solid white;
        padding: 12px 30px;
        color: white;
        font-weight: 600;
        border-radius: 25px;
        cursor: pointer;
        font-size: 16px;
        transition: 0.3s;
      }
      .side-panel button:hover {
        background: white;
        color: black;
      }
      /* Animation states */
      .wrapper.sign-up-mode .form-container.sign-in {
        transform: translateX(-100%);
        opacity: 0;
      }
      .wrapper.sign-up-mode .form-container.sign-up {
        transform: translateX(-100%);
        opacity: 1;
      }
      .form-container.sign-up {
        position: absolute;
        left: 50%;
        opacity: 0;
        top: 0;
        height: 100%;
        background: rgba(255, 255, 255, 0.05);
      }
    </style>
  </head>
  <body>
    <div class="wrapper" id="wrapper">
     <!-- Sign In Form -->
<div class="form-container sign-in">
  <form class="form" method="POST" action="login.php">
    <h2>Welcome Back to <span style="font-size: 38px">LUMORA</span></h2>

    <!-- Show login messages -->
    <?php if (isset($_SESSION['login_error'])): ?>
      <p style="color: red"><?= $_SESSION['login_error']; unset($_SESSION['login_error']); ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION['signup_success'])): ?>
      <p style="color: limegreen"><?= $_SESSION['signup_success']; unset($_SESSION['signup_success']); ?></p>
    <?php endif; ?>

    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Sign In</button>
  </form>
</div>


<!-- Sign Up Form -->
<div class="form-container sign-up">
  <form class="form" method="POST" action="signup.php">
    <h2>Create Your <span style="font-size: 38px">LUMORA</span> Account</h2>

    <!-- Show signup messages -->
    <?php if (isset($_SESSION['signup_error'])): ?>
      <p style="color: red"><?= $_SESSION['signup_error']; unset($_SESSION['signup_error']); ?></p>
    <?php endif; ?>

    <input type="text" name="name" placeholder="Full Name" required />
    <input type="email" name="email" placeholder="Email" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Join LUMORA</button>
  </form>
</div>


      <!-- Side Panel -->
      <div class="side-panel">
        <div class="side-panel-content" id="panelContent">
          <h3>New Here?</h3>
          <p>
            Join the world of LUMORA and explore luxury fashion collections.
          </p>
          <button id="toggleBtn">Sign Up</button>
        </div>
      </div>
    </div>

    <script>
      const wrapper = document.getElementById("wrapper");
      const toggleBtn = document.getElementById("toggleBtn");
      const panelContent = document.getElementById("panelContent");

      toggleBtn.addEventListener("click", () => {
        wrapper.classList.toggle("sign-up-mode");
        if (wrapper.classList.contains("sign-up-mode")) {
          panelContent.innerHTML = `
                <h3>Already a Member?</h3>
                <p>Sign in and continue your luxury shopping journey.</p>
                <button id="toggleBtn">Sign In</button>
            `;
        } else {
          panelContent.innerHTML = `
                <h3>New Here?</h3>
                <p>Join the world of LUMORA and explore luxury fashion collections.</p>
                <button id="toggleBtn">Sign Up</button>
            `;
        }
        document
          .getElementById("toggleBtn")
          .addEventListener("click", () => toggleBtn.click());
      });
    </script>
  </body>
</html>
