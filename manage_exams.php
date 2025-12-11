<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'cms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle new exam creation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $course_id = $_POST['course_id'];
    $exam_name = $_POST['examname'];
    $date = $_POST['date'];
    $total_marks = $_POST['total_marks'];

    $sql = "INSERT INTO exam (course_id, examname, date, total_marks) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issi", $course_id, $exam_name, $date, $total_marks);

    if ($stmt->execute()) {
        $success_message = "Exam added successfully!";
    } else {
        $error_message = "Error adding exam.";
    }
}

// Fetch exams
$sql = "SELECT exam.*, course.course_name FROM exam
        JOIN course ON exam.course_id = course.course_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Exams</title>
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

        form select,
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
    <h1>Manage Exams</h1>
    <div class="container">
        <?php if (!empty($success_message)) echo "<p class='success'>$success_message</p>"; ?>
        <?php if (!empty($error_message)) echo "<p class='error'>$error_message</p>"; ?>

        <!-- Form to Add New Exam -->
        <form method="POST" action="">
            <select name="course_id" required>
                <option value="" disabled selected>Select Course</option>
                <?php
                $courses = $conn->query("SELECT * FROM course");
                while ($course = $courses->fetch_assoc()): ?>
                    <option value="<?php echo $course['course_id']; ?>"><?php echo $course['course_name']; ?></option>
                <?php endwhile; ?>
            </select>
            <input type="text" name="examname" placeholder="Exam Name" required>
            <input type="date" name="date" required>
            <input type="number" name="total_marks" placeholder="Total Marks" required>
            <button type="submit">Add Exam</button>
        </form>

        <!-- List of Exams -->
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Exam Name</th>
                    <th>Date</th>
                    <th>Total Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['examname']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td><?php echo htmlspecialchars($row['total_marks']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>

</html>