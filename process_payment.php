<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted data
    $course_id = intval($_POST['course_id']);
    $course_amount = floatval($_POST['course_amount']);
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    // Validate input (basic validation)
    if (empty($course_id) || empty($course_amount) || empty($card_number) || empty($expiry_date) || empty($cvv)) {
        die("<p class='error'>All fields are required.</p>");
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'cms');

    // Check connection
    if ($conn->connect_error) {
        die("<p class='error'>Connection failed: " . $conn->connect_error . "</p>");
    }

    // Insert payment details into the database
    $sql = "INSERT INTO payments (course_id, amount, card_number, expiry_date, cvv, paymentdate) VALUES (?, ?, ?, ?, ?, NOW())";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("<p class='error'>Error preparing query: " . $conn->error . "</p>");
    }

    $stmt->bind_param("idsss", $course_id, $course_amount, $card_number, $expiry_date, $cvv);

    // Execute the statement
    if ($stmt->execute()) {
        // Fetch the video link for the course
        $video_sql = "SELECT video_link FROM course WHERE course_id = ?";
        $video_stmt = $conn->prepare($video_sql);
        $video_stmt->bind_param("i", $course_id);
        $video_stmt->execute();
        $video_result = $video_stmt->get_result();

        echo "<div class='container'>";
        if ($video_result->num_rows > 0) {
            $row = $video_result->fetch_assoc();
            $video_link = $row['video_link'];
            echo "<h1>Payment Successful!</h1>";
            echo "<p>Thank you for your payment. You can start your learning now.</p>";
            echo "<button class='btn' onclick=\"window.location.href='$video_link'\">Start Learning</button>";
        } else {
            echo "<h1>Payment Successful!</h1>";
            echo "<p>Thank you for your payment. However, the video link for this course is not available.</p>";
        }
        echo "</div>";
        $video_stmt->close();
    } else {
        echo "<div class='container'><p class='error'>Error processing payment: " . $stmt->error . "</p></div>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "<div class='container'><p class='error'>Invalid request.</p></div>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #28a745;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .btn {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
</body>

</html>