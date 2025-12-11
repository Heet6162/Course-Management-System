<?php
session_start();

// Database connection
$conn = new mysqli('localhost', 'root', '', 'cms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle evaluation addition
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_id = trim($_POST['std_id']);
    $course_id = trim($_POST['course_id']);
    $subject_id = trim($_POST['sub_id']);
    $score = trim($_POST['score']);
    $remarks = trim($_POST['remarks']);
    $date_evaluated = trim($_POST['date_evaluated']);

    // Validate inputs
    if (empty($student_id) || empty($course_id) || empty($subject_id)) {
        $error_message = "Student, course, and subject are required.";
    } elseif (!is_numeric($score) || $score < 0) {
        $error_message = "Score must be a positive number.";
    } elseif (empty($date_evaluated)) {
        $error_message = "Evaluation date is required.";
    } else {
        // Insert the evaluation into the database
        $sql = "INSERT INTO evaluation (std_id, course_id, sub_id, score, remarks, date_evaluated) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiisss", $student_id, $course_id, $subject_id, $score, $remarks, $date_evaluated);

        if ($stmt->execute()) {
            $success_message = "Evaluation added successfully!";
        } else {
            $error_message = "Error adding evaluation: " . $stmt->error;
        }
    }
}

// Fetch evaluations
$sql = "SELECT evaluation.*, 
               student.f_name ,
               course.course_name, 
               subject.subname
        FROM evaluation
        LEFT JOIN student ON evaluation.std_id = student.std_id
        LEFT JOIN course ON evaluation.course_id = course.course_id
        LEFT JOIN subject ON evaluation.sub_id = subject.sub_id";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Evaluations</title>
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
            max-width: 800px;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
        }

        .form-container input,
        .form-container select,
        .form-container textarea,
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
    <h1>Manage Evaluations</h1>
    <?php if (!empty($success_message)) echo "<p class='message success'>$success_message</p>"; ?>
    <?php if (!empty($error_message)) echo "<p class='message error'>$error_message</p>"; ?>

    <!-- Form to Add New Evaluation -->


    <!-- List of Evaluations -->
    <table>
        <thead>
            <tr>
                <th>Evaluation ID</th>
                <th>Student</th>
                <th>Course</th>
                <th>Subject</th>
                <th>Score</th>
                <th>Remarks</th>
                <th>Date Evaluated</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['evaluation_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['f_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['subject']); ?></td>
                    <td><?php echo htmlspecialchars($row['score']); ?></td>
                    <td><?php echo htmlspecialchars($row['remarks']); ?></td>
                    <td><?php echo htmlspecialchars($row['date_evaluated']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>