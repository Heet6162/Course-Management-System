<?php
include('include/db.php');

// Fetch subjects and their exams
$query = "SELECT subjects.name AS subject_name, exams.id AS exam_id, exams.name AS exam_name, exams.duration, exams.total_marks
          FROM exams
          JOIN subjects ON exams.subject_id = subjects.id";
$stmt = $pdo->prepare($query);
$stmt->execute();
$exams = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Available Exams</h1>
        <div class="exam-list">
            <?php foreach ($exams as $exam): ?>
                <div class="exam-item">
                    <h2><?php echo htmlspecialchars($exam['subject_name']); ?> -
                        <?php echo htmlspecialchars($exam['exam_name']); ?></h2>
                    <p>Duration: <?php echo $exam['duration']; ?> minutes</p>
                    <p>Total Marks: <?php echo $exam['total_marks']; ?></p>
                    <a href="start_exam.php?exam_id=<?php echo $exam['exam_id']; ?>" class="start-button">Start Exam</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>