<?php
session_start();

// Check if the user is logged in and is a student
if (!isset($_SESSION['id']) || $_SESSION['type'] !== 'student') {
    header("Location: login.php");
    exit;
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'cms');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the logged-in student ID
$std_id = $_SESSION['id'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $subject = $_POST['subject'];
    $score = $_POST['score'];
    $remarks = $_POST['remarks'];
    $date_evaluated = date('Y-m-d');

    // Insert the evaluation into the database
    $sql = "INSERT INTO evaluation (std_id, subject, score, remarks, date_evaluated) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isiss", $std_id, $subject, $score, $remarks, $date_evaluated);

    if ($stmt->execute()) {
        $success_message = "Evaluation submitted successfully!";
    } else {
        $error_message = "Error submitting evaluation. Please try again.";
    }
}

// Fetch evaluations for the logged-in student
$sql = "SELECT subject, score, remarks, date_evaluated FROM evaluation WHERE std_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $std_id);
$stmt->execute();
$result = $stmt->get_result();
$evaluations = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 20px;
            margin: 0;
        }

        .evaluation-container {
            width: 80%;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        .form-container {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .success {
            color: green;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="evaluation-container">
        <h1>Submit Your Evaluation</h1>
        <?php if (!empty($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <?php if (!empty($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <div class="form-container">
            <form method="POST" action="">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" placeholder="Enter the subject" required>

                <label for="score">Score</label>
                <input type="number" id="score" name="score" placeholder="Enter the score" required>

                <label for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks" rows="4" placeholder="Enter your remarks" required></textarea>

                <button type="submit">Submit Evaluation</button>
            </form>
        </div>
    </div>

    <div class="evaluation-container">
        <h1>Your Evaluations</h1>
        <table>
            <tr>
                <th>Subject</th>
                <th>Score</th>
                <th>Remarks</th>
                <th>Date Evaluated</th>
            </tr>
            <?php foreach ($evaluations as $evaluation): ?>
                <tr>
                    <td><?php echo htmlspecialchars($evaluation['subject']); ?></td>
                    <td><?php echo htmlspecialchars($evaluation['score']); ?></td>
                    <td><?php echo htmlspecialchars($evaluation['remarks']); ?></td>
                    <td><?php echo htmlspecialchars($evaluation['date_evaluated']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>