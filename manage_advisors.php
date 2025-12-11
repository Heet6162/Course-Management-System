<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'cms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle advisor addition
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $advisor_name = trim($_POST['advisorname']);
    $advisor_email = trim($_POST['advisor_email']);
    $advisor_phone = trim($_POST['advisor_phone']);

    // Validate inputs
    if (empty($advisor_name) || empty($advisor_email) || empty($advisor_phone)) {
        $error_message = "All fields are required.";
    } elseif (!filter_var($advisor_email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format.";
    } else {
        // Insert the new advisor into the database
        $sql = "INSERT INTO advisor (advisorname, advisor_email, advisor_phone) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $advisor_name, $advisor_email, $advisor_phone);

        if ($stmt->execute()) {
            $success_message = "Advisor added successfully!";
        } else {
            $error_message = "Error adding advisor: " . $stmt->error;
        }
    }
}

// Handle advisor deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $sql = "DELETE FROM advisor WHERE advisor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        $success_message = "Advisor deleted successfully!";
    } else {
        $error_message = "Error deleting advisor: " . $stmt->error;
    }
}

// Fetch advisors
$sql = "SELECT * FROM advisor";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Advisors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-container {
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container input,
        .form-container button {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        td {
            color: #333;
        }

        .action-button {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
        }

        .action-button:hover {
            color: #0056b3;
        }

        .message {
            text-align: center;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Manage Advisors</h1>
    <?php if (!empty($success_message)) echo "<p class='message success'>$success_message</p>"; ?>
    <?php if (!empty($error_message)) echo "<p class='message error'>$error_message</p>"; ?>

    <!-- Form to Add New Advisor -->
    <div class="form-container">
        <form method="POST" action="">
            <input type="text" name="advisorname" placeholder="Advisor Name" required>
            <input type="email" name="advisor_email" placeholder="Advisor Email" required>
            <input type="text" name="advisor_phone" placeholder="Advisor Phone" required>
            <button type="submit">Add Advisor</button>
        </form>
    </div>

    <!-- List of Advisors -->
    <table>
        <thead>
            <tr>
                <th>Advisor ID</th>
                <th>Advisor Name</th>
                <th>Advisor Email</th>
                <th>Advisor Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['advisor_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['advisorname']); ?></td>
                    <td><?php echo htmlspecialchars($row['advisor_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['advisor_phone']); ?></td>
                    <td>
                        <a href="?delete_id=<?php echo $row['advisor_id']; ?>" class="action-button"
                            onclick="return confirm('Are you sure you want to delete this advisor?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>