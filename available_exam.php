<?php
include('include/db.php');

// Fetch all exams from the database
$query = "SELECT exam_id, examname, duration, total_marks FROM exam";
$stmt = $pdo->prepare($query);
$stmt->execute();
$exams = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Exams</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        background: white;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
        color: #333;
    }

    ul {
        list-style: none;
        padding: 0;
    }

    li {
        margin-bottom: 20px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }

    button {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    button:hover:not(:disabled) {
        background-color: #0056b3;
    }
</style>


<body>
    <div class="container">
        <h1>Available Exams</h1>
        <?php if (count($exams) > 0): ?>
            <ul>
                <?php foreach ($exams as $exam): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($exam['examname']); ?></strong>
                        <p>Duration: <?php echo $exam['duration']; ?> minutes</p>
                        <p>Total Marks: <?php echo $exam['total_marks']; ?></p>
                        <a href="start_exam.php?exam_id=<?php echo $exam['exam_id']; ?>">
                            <button>Start Exam</button>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No exams available at the moment.</p>
        <?php endif; ?>
    </div>
</body>

</html>