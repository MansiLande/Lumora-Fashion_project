<?php
include 'db.php'; // your DB connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $designer_name   = $_POST['designer_name'];
    $designer_image  = $_POST['designer_image'];
    $appointment_type= $_POST['appointment_type'];
    $appointment_date= $_POST['appointment_date'];
    $appointment_time= $_POST['appointment_time'];
    $customer_name   = $_POST['customer_name'];
    $email           = $_POST['email'];
    $phone           = $_POST['phone'];
    $special_requests= $_POST['special_requests'];

    $stmt = $conn->prepare("INSERT INTO appointments 
        (designer_name, designer_image, appointment_type, appointment_date, appointment_time, customer_name, email, phone, special_requests) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $designer_name, $designer_image, $appointment_type, $appointment_date, $appointment_time, $customer_name, $email, $phone, $special_requests);

    if ($stmt->execute()) {
        echo "<script>alert('Your appointment has been booked successfully!'); window.location.href='index.php#book-appointment';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
