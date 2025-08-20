<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if ($name === "" || $email === "" || $password === "") {
        $_SESSION['signup_error'] = "All fields are required!";
    } else {
        // check if email already exists
        $check = $conn->prepare("SELECT id FROM users WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        $res = $check->get_result();

        if ($res->num_rows > 0) {
            $_SESSION['signup_error'] = "Email already registered!";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $name, $email, $password); // directly store plain password


            if ($stmt->execute()) {
                $_SESSION['signup_success'] = "Account created! Please log in.";
            } else {
                $_SESSION['signup_error'] = "Something went wrong. Please try again.";
            }
        }
    }

    header("Location: signin-signup.php"); 
    exit;
}
?>
