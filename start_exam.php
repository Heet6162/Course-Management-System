<?php
include('include/db.php');

// Get exam_id from the query string
$exam_id = isset($_GET['exam_id']) ? $_GET['exam_id'] : 0;

// Fetch exam details
$query = "SELECT examname, duration, total_marks FROM exam WHERE exam_id = :exam_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['exam_id' => $exam_id]);
$exam = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch questions for the exam
$query = "SELECT * FROM questions WHERE exam_id = :exam_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['exam_id' => $exam_id]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Redirect if no exam is found
if (!$exam) {
    die("Invalid exam ID.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($exam['examname']); ?></title>
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

h1,
h2 {
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

button:hover {
    background-color: #0056b3;
}
</style>

<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($exam['examname']); ?></h1>
        <form method="post" action="submit_exam.php?exam_id=<?php echo $exam_id; ?>">
            <?php foreach ($questions as $index => $question): ?>
            <div class="question">
                <p><strong>Q<?php echo $index + 1; ?>:</strong> <?php echo htmlspecialchars($question['question']); ?>
                </p>
                <?php for ($i = 1; $i <= 4; $i++): ?>
                <label>
                    <input type="radio" name="answers[<?php echo $question['id']; ?>]" value="<?php echo $i; ?>">
                    <?php echo htmlspecialchars($question["option_$i"]); ?>
                </label><br>
                <?php endfor; ?>
            </div>
            <?php endforeach; ?>
            <button type="submit">Submit Exam</button>
        </form>
    </div>
</body>

</html>