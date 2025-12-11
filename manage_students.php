<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'cms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle new student addition
if (isset($_POST['add_student'])) {
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $s_phone = $_POST['s_phone'];
    $s_address = $_POST['s_address'];
    $s_email = $_POST['s_email'];
    $s_username = $_POST['s_username'];
    $s_password = password_hash($_POST['s_password'], PASSWORD_DEFAULT); // Secure password hashing

    $sql = "INSERT INTO student (f_name, l_name, s_phone, s_address, s_email, s_username, s_password)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $f_name, $l_name, $s_phone, $s_address, $s_email, $s_username, $s_password);

    if ($stmt->execute()) {
        $success_message = "Student added successfully!";
    } else {
        $error_message = "Error adding student: " . $conn->error;
    }
}

// Handle student deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // First, delete dependent rows from the evaluation table
    $sql = "DELETE FROM evaluation WHERE std_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();

    // Now, delete the student from the student table
    $sql = "DELETE FROM student WHERE std_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        $success_message = "Student deleted successfully!";
    } else {
        $error_message = "Error deleting student: " . $stmt->error;
    }
}

// Fetch all students
$sql = "SELECT * FROM student";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Manage Student</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
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

        .form-container {
            margin: 20px 0;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container input,
        .form-container button {
            margin-bottom: 10px;
            padding: 10px;
            font-size: 16px;
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
    </style>
</head>

<body>
    <?php if (!empty($success_message)) echo "<p style='color: green;'>$success_message</p>"; ?>
    <?php if (!empty($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>

    <!-- Add New Student Form -->


    <!-- List of Students -->
    <h2>Student List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Email</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['std_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['f_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['l_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['s_phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['s_address']); ?></td>
                    <td><?php echo htmlspecialchars($row['s_email']); ?></td>
                    <td><?php echo htmlspecialchars($row['s_username']); ?></td>
                    <td>
                        <a href="?delete_id=<?php echo $row['std_id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this student?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>