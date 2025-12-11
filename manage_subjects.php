<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'cms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle subject addition
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject_name = trim($_POST['subname']);
    $course_id = trim($_POST['course_id']);

    // Validate inputs
    if (empty($subject_name)) {
        $error_message = "Subject name is required.";
    } elseif (!is_numeric($course_id) || $course_id <= 0) {
        $error_message = "Invalid course ID.";
    } else {
        // Insert the new subject into the database
        $sql = "INSERT INTO subject (subname, course_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $subject_name, $course_id);

        if ($stmt->execute()) {
            $success_message = "Subject added successfully!";
        } else {
            $error_message = "Error adding subject: " . $stmt->error;
        }
    }
}

// Fetch subjects
$sql = "SELECT subject.*, course.course_name 
        FROM subject 
        LEFT JOIN course ON subject.course_id = course.course_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Subjects</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-container {
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            max-width: 600px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container input,
        .form-container button,
        .form-container select {
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
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
    <h1>Manage Subjects</h1>
    <?php if (!empty($success_message)) echo "<p class='message success'>$success_message</p>"; ?>
    <?php if (!empty($error_message)) echo "<p class='message error'>$error_message</p>"; ?>

    <!-- Form to Add New Subject -->
    <div class="form-container">
        <form method="POST" action="">
            <input type="text" name="subname" placeholder="Subject Name" required>
            <select name="course_id" required>
                <option value="" disabled selected>Select Course</option>
                <?php
                // Fetch courses for the dropdown
                $courses = $conn->query("SELECT * FROM course");
                while ($course = $courses->fetch_assoc()): ?>
                    <option value="<?php echo $course['course_id']; ?>">
                        <?php echo htmlspecialchars($course['course_name']); ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button type="submit">Add Subject</button>
        </form>
    </div>

    <!-- List of Subjects -->
    <table>
        <thead>
            <tr>
                <th>Subject ID</th>
                <th>Subject Name</th>
                <th>Course Name</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['sub_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['subname']); ?></td>
                    <td><?php echo htmlspecialchars($row['course_name'] ?? 'N/A'); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>