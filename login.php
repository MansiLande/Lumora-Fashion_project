<?php 
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, email, password FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: signin-signup.php");
        exit;
    }

    $user = $res->fetch_assoc();

    // ⚠️ If you’re storing plain text passwords:
    if ($password === $user['password']) {
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['username']  = $user['name'];
        $_SESSION['email']     = $user['email']; // ✅ Save email in session
        header("Location: index.php");
        exit;
    } else {
        $_SESSION['login_error'] = "Invalid email or password.";
        header("Location: signin-signup.php");
        exit;
    }
}
