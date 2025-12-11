<?php
// forgot_password.php

// Database connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=cms", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (isset($_POST['reset_password'])) {
    $username = trim($_POST['username']);
    $new_password = trim($_POST['new_password']);
    $errorMessage = "";

    // Validate password length
    if (strlen($new_password) < 8) {
        $errorMessage = "Password must be at least 8 characters long.";
    } else {
        $query = "UPDATE student SET s_password = :new_password WHERE s_username = :username";
        $stmt = $pdo->prepare($query);

        try {
            $stmt->execute(['new_password' => $new_password, 'username' => $username]);

            // Check if any row was updated
            if ($stmt->rowCount() > 0) {
                header("Location: login.php");
                exit();
            } else {
                $errorMessage = "Username not found.";
            }
        } catch (PDOException $e) {
            $errorMessage = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form method="post" action="">
        <h2>Reset Password</h2>
        <label>Username:</label>
        <input type="text" name="username" required>
        <label>New Password:</label>
        <input type="password" name="new_password" required>
        <button type="submit" name="reset_password">Reset Password</button>
        <?php if (!empty($errorMessage)) echo "<p>$errorMessage</p>"; ?>
    </form>
</body>

<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f5f5f5;
    }

    form {
        width: 100%;
        max-width: 400px;
        padding: 30px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    form h2 {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }

    form label {
        display: block;
        text-align: left;
        font-size: 14px;
        color: #666;
        margin-top: 20px;
        margin-bottom: 5px;
    }

    form input[type="text"],
    form input[type="password"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button[type="submit"] {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-top: 20px;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    form p {
        color: red;
        font-size: 14px;
        margin-top: 10px;
    }
</style>

</html>