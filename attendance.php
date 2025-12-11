<?php
// Database connection (update with your credentials)
$host = 'localhost';
$db = 'cms';
$user = 'root';
$password = '';
$conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark_attendance'])) {
    $sub_id = $_POST['sub_id'];
    $student_attendance = $_POST['attendance']; // array of student_id => status
    $date = date('Y-m-d');

    foreach ($student_attendance as $std_id => $status) {
        // Insert or update attendance
        $query = "INSERT INTO attendance (sub_id, std_id, date, status) VALUES (:sub_id, :std_id, :date, :status)
                  ON DUPLICATE KEY UPDATE status = :status_update";
        $stmt = $conn->prepare($query);
        $stmt->execute([
            ':sub_id' => $sub_id,
            ':std_id' => $std_id,
            ':date' => $date,
            ':status' => $status,
            ':status_update' => $status
        ]);

        // Update rewards if status is 'Present'
        if ($status === 'Present') {
            $reward_query = "INSERT INTO attendance_rewards (std_id, total_points, last_updated)
                             VALUES (:std_id, 10, :last_updated)
                             ON DUPLICATE KEY UPDATE total_points = total_points + 10, last_updated = :last_updated_update";
            $reward_stmt = $conn->prepare($reward_query);
            $reward_stmt->execute([
                ':std_id' => $std_id,
                ':last_updated' => $date,
                ':last_updated_update' => $date
            ]);
        }
    }
    echo "Attendance marked successfully!";
}

// Fetch subjects and students for display
$subjects = $conn->query("SELECT * FROM subject")->fetchAll(PDO::FETCH_ASSOC);
$students = $conn->query("SELECT * FROM student")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance Feature</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }

        h1 {
            color: #333;
            text-align: center;
            margin-top: 20px;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
        }

        .btn {
            display: inline-block;
            background: #5cb85c;
            color: #fff;
            padding: 10px 15px;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
        }

        .btn:hover {
            background: #4cae4c;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Mark Attendance</h1>

        <form method="POST" action="">
            <label for="sub_id">Select Subject:</label>
            <select name="sub_id" id="sub_id" required>
                <option value="">-- Select Subject --</option>
                <?php foreach ($subjects as $subject): ?>
                    <option value="<?php echo $subject['sub_id']; ?>">
                        <?php echo htmlspecialchars($subject['subname']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Attendance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo $student['std_id']; ?></td>
                            <td><?php echo htmlspecialchars($student['f_name']); ?></td>
                            <td>
                                <label>
                                    <input type="radio" name="attendance[<?php echo $student['std_id']; ?>]" value="Present"
                                        required> Present
                                </label>
                                <label>
                                    <input type="radio" name="attendance[<?php echo $student['std_id']; ?>]" value="Absent">
                                    Absent
                                </label>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <button type="submit" name="mark_attendance" class="btn">Submit Attendance</button>
        </form>
    </div>
</body>

</html>