<?php
//include('include/db.php');
// Start session to manage user sessions
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .login-container {
            width: 400px;
            padding: 20px;
            background-color: #d3d3d3;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 100px;
            height: 100px;
        }

        .login-container input[type="text"],
        .login-container input[type="password"],
        .login-container select {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .login-container button {
            width: 40%;
            padding: 10px;
            margin: 10px 5px;
            background-color: #555;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .login-container button:hover {
            background-color: #333;
        }

        .login-container a {
            display: block;
            color: #555;
            text-decoration: none;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <!-- Add the logo image -->
        <img src="image/logo.jpeg" alt="Logo" class="logo">
        <form method="POST" action="">
            <input type="text" name="l_user" placeholder="Username" required />
            <input type="password" name="l_pass" placeholder="Password" required />
            <select name="user_type" required>
                <option value="admin">Admin</option>
                <option value="student">Student</option>
                <option value="instructor">Instructor</option>
            </select>
            <button type="submit" name="l_login">Login</button>
        </form>
        <a href="signup.php">Sign Up</a>
        <p><a href="forgot_password.php">Forgot password?</a></p>
    </div>

    <?php
    if (isset($_POST['l_login'])) {
        // Ensure the database connection is established
        if (!isset($pdo) || !$pdo) {
            die("<p style='color: red;'>Database connection not established.</p>");
        }

        // Prepare queries for different user types
        $queries = [
            'admin' => "SELECT admin_id FROM admin WHERE a_username = :username AND a_password = :password",
            'student' => "SELECT std_id FROM student WHERE s_username = :username AND s_password = :password",
            'instructor' => "SELECT instructor_id FROM instructor WHERE i_username = :username AND i_password = :password"
        ];

        // Get the selected user type and query
        $user_type = $_POST['user_type'];
        $query = $queries[$user_type] ?? null;

        if ($query) {
            try {
                // Prepare and execute the query
                $stmt = $pdo->prepare($query);
                $stmt->execute([
                    'username' => $_POST['l_user'],
                    'password' => $_POST['l_pass']
                ]);

                // Check login credentials
                if ($stmt->rowCount() === 1) {
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Set session variables
                    $_SESSION['type'] = $user_type; // User type (admin/student/instructor)
                    $_SESSION['id'] = reset($user); // User ID (admin_id/std_id/instructor_id)
                    $_SESSION['username'] = $_POST['l_user']; // Username for display

                    // Redirect based on user type
                    if ($user_type == 'admin') {
                        header('Location: admin.php');
                    } elseif ($user_type == 'student') {
                        header('Location: terms.php');
                    } elseif ($user_type == 'instructor') {
                        header('Location: attendance.php');
                    }
                    exit;
                } else {
                    echo "<p style='color: red;'>Invalid username/password combination.</p>";
                }
            } catch (PDOException $e) {
                echo "<p style='color: red;'>Database error: " . $e->getMessage() . "</p>";
            }
        } else {
            echo "<p style='color: red;'>Invalid user type selected.</p>";
        }
    }
    ?>
</body>

</html>