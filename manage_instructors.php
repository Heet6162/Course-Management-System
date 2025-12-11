<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'cms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle new instructor submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['instructorname'];
    $email = $_POST['insemail'];
    $phone = $_POST['instphone'];

    $sql = "INSERT INTO instructor (instructorname, insemail, instphone) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $phone);

    if ($stmt->execute()) {
        $success_message = "Instructor added successfully!";
    } else {
        $error_message = "Error adding instructor.";
    }
}

// Fetch instructors
$sql = "SELECT * FROM instructor";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Instructors</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
            color: #444;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .success {
            color: green;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .error {
            color: red;
            margin-bottom: 20px;
            font-weight: bold;
        }

        form {
            margin-bottom: 20px;
        }

        form input,
        form button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <h1>Manage Instructors</h1>
    <div class="container">
        <?php if (!empty($success_message)) echo "<p class='success'>$success_message</p>"; ?>
        <?php if (!empty($error_message)) echo "<p class='error'>$error_message</p>"; ?>

        <!-- Form to Add New Instructor -->
        <form method="POST" action="">
            <input type="text" name="instructorname" placeholder="Instructor Name" required>
            <input type="email" name="insemail" placeholder="Email" required>
            <input type="text" name="instphone" placeholder="Phone" required>
            <button type="submit">Add Instructor</button>
        </form>

        <!-- List of Instructors -->
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['instructorname']); ?></td>
                        <td><?php echo htmlspecialchars($row['insemail']); ?></td>
                        <td><?php echo htmlspecialchars($row['instphone']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>