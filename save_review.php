<?php
include 'db.php'; // ✅ your DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name   = trim($_POST['name']);
    $review = trim($_POST['review']);
    $rating = intval($_POST['rating']);

    if (!empty($name) && !empty($review) && $rating >= 1 && $rating <= 5) {
        $stmt = $conn->prepare("INSERT INTO reviews (name, review, rating) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $name, $review, $rating);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: index.php#reviews-section"); // redirect back to reviews
    exit;
}
?>
