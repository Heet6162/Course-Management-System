<?php
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'student') {
    header("Location: login.php");
    exit;
}

// Get the logged-in student ID
$std_id = $_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        width: 1000px;
        height: 500px;
        background-image: url('image/bg1.jpg');
        background-size: 1050px auto;
        background-position: center;
        background-repeat: no-repeat;
        background-color: #d3d3d3;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .logo {
        text-align: center;
        margin-bottom: 20px;
    }

    .logo-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
    }

    .nav {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .nav select {
        padding: 5px;
        font-size: 16px;
    }

    .action-buttons {
        position: absolute;
        top: 20px;
        right: 5px;
        display: flex;
        gap: 10px;
    }

    .action-buttons button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border: none;
        background-color: white;
        color: white;
        border-radius: 5px;
    }

    .action-buttons button:hover {
        background-color: orange;
    }

    /* course button */
    .cbutton {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 50px;
        padding: 100px 300px;
    }

    .cbutton button {
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        border: none;
        background-color: white;
        color: black;
        border-radius: 5px;
    }

    .cbutton button:hover {
        background-color: orange;
    }

    .content {
        display: flex;
        gap: 20px;
    }

    .text-content {
        flex: 1;
    }

    .line {
        width: 100%;
        height: 20px;
        background-color: purple;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .image-placeholder {
        width: 300px;
        height: 200px;
        background-color: #000;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
    }
</style>

<body>
    <div class="container">
        <!-- Logo Section -->
        <div class="logo">
            <img src="image/logo.jpeg" alt="Logo" class="logo-image">
        </div>

        <!-- Navigation Buttons -->
        <div class="nav">
            <div class="cbutton">
                <button onclick="window.location.href='home1.php'">Course</button>
                <button onclick="window.location.href='available_exam.php'">Exam</button>
                <button onclick="window.location.href='evaluation.php'">Evaluation</button>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <!-- Link to the logged-in student's profile -->
            <button><a href="profile.php" class="action-button">Profile</a></button>
            <!-- <a href="logout.php" class="action-button">Logout</a> -->
        </div>
    </div>
</body>

</html>