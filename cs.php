<?php
// Start the session to use session variables
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the course details from the form
    $course_name = $_POST['course_name'];
    $instructor = $_POST['instructor'];
    $schedule = $_POST['schedule'];
    $price = 50; // Set a fixed price or retrieve it dynamically from the database

    // Create an array with course details
    $course = [
        'course_name' => $course_name,
        'instructor' => $instructor,
        'schedule' => $schedule,
        'price' => $price // Use 'price' consistently
    ];

    // Add the course to the session cart
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $_SESSION['cart'][] = $course;

    // Redirect to the cart page
    header('Location: addtocart.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Computer Science Course</title>
</head>
<style>
    /* Add CSS styling */
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f0f0;
    }

    .container {
        text-align: center;
        background-color: #ffffff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    button {
        background-color: #4CAF50;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    button:hover {
        background-color: #45a049;
    }
</style>

<body>
    <div class="container">
        <h1>Computer Science Course</h1>
        <div class="course-details">
            <p><strong>Subject Name:</strong> Data Structure and Algorithm</p>
            <p><strong>Instructor Name:</strong> Dr. Chirag Patel</p>
            <p><strong>Schedule of Subject:</strong> 10:00 AM Every Monday</p>
            <p><strong>Payment:</strong> 10:00 AM Every Monday</p>
        </div>

        <!-- Form to handle Add to Cart button -->
        <form action="cs.php" method="POST">
            <input type="hidden" name="course_name" value="Data Structure and Algorithm">
            <input type="hidden" name="instructor" value="Dr. Chirag Patel">
            <input type="hidden" name="schedule" value="10:00 AM Every Monday">
            <button type="submit">Proceed to payment</button>
        </form>
    </div>
</body>

</html>