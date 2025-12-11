<?php
session_start();

// Check if the user is logged in and is a student
if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'student') {
    header("Location: login.php");
    exit;
}

// Get the logged-in student's ID
$std_id = $_SESSION['id'];

// Database connection
$conn = new mysqli('localhost', 'root', '', 'cms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch student details based on std_id
$sql = "SELECT * FROM student WHERE std_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $std_id); // Bind as integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $student = $result->fetch_assoc();
} else {
    echo "Student not found!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .profile-container {
            width: 400px;
            padding: 20px;
            background-color: #d3d3d3;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        h2 {
            color: #333;
            margin-bottom: 10px;
        }

        p {
            margin: 5px 0;
            font-size: 16px;
            color: #666;
        }

        a {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="profile-container">
        <!-- <img src="default-profile.png" alt="Profile Picture" class="profile-pic"> -->
        <h2><?php echo htmlspecialchars($student['f_name'] . ' ' . $student['l_name']); ?></h2>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($student['s_email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($student['s_phone']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($student['s_address']); ?></p>
        <a href="home.php">Back to Home</a>
    </div>
</body>

</html>