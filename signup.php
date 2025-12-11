<?php
// Database connection
try {
    $pdo = new PDO("mysql:host=localhost;dbname=cms", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

if (isset($_POST['signup'])) {
    // Sanitize and validate input
    $f_name = trim($_POST['f_name']);
    $l_name = trim($_POST['l_name']);
    $username = trim($_POST['username']); // Updated to match the form field's name attribute
    $password = trim($_POST['password']); // Updated to match the form field's name attribute
    $phone = trim($_POST['s_phone']);
    $email = trim($_POST['s_email']);
    $address = trim($_POST['s_address']);
    $errorMessage = "";

    // Validate password length
    if (strlen($password) < 8) {
        $errorMessage = "Password must be at least 8 characters long.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO student (f_name, l_name, s_phone, s_address, s_email, s_username, s_password)
                  VALUES (:f_name, :l_name, :s_phone, :s_address, :s_email, :s_username, :s_password)";
        $stmt = $pdo->prepare($query);

        try {
            $stmt->execute([
                'f_name' => $f_name,
                'l_name' => $l_name,
                's_phone' => $phone,
                's_address' => $address,
                's_email' => $email,
                's_username' => $username,
                's_password' => $password,
            ]);
            header("Location: login.php");
            exit();
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
    <title>Sign-Up Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <form method="post" action="">
        <label>First Name:</label>
        <input type="text" name="f_name" required>
        <label>Last Name:</label>
        <input type="text" name="l_name" required>
        <label>Username:</label>
        <input type="text" name="username" required> <!-- Updated name -->
        <label>Password:</label>
        <input type="password" name="password" required> <!-- Updated name -->
        <label>Phone:</label>
        <input type="text" name="s_phone">
        <label>Email:</label>
        <input type="email" name="s_email">
        <label>Address:</label>
        <input type="text" name="s_address">
        <button type="submit" name="signup">Sign Up</button>
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
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    form label {
        display: block;
        text-align: left;
        font-size: 14px;
        color: #666;
        margin-top: 20px;
        margin-bottom: 4px;
    }

    form input[type="text"],
    form input[type="email"],
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
        padding: 10px;
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