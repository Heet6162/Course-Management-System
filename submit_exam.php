<?php
include('include/db.php');

// Get exam_id from the query string
$exam_id = isset($_GET['exam_id']) ? $_GET['exam_id'] : 0;

// Replace with a real student ID (e.g., from session)
$std_id = 11;
$std_id = 12;
$std_id = 13;
$std_id = 14;
$std_id = 15;
$std_id = 16;
$std_id = 17;
$std_id = 18;
$std_id = 19;
$std_id = 20;

// Get submitted answers
$answers = isset($_POST['answers']) ? $_POST['answers'] : [];

// Fetch correct answers for the exam
$query = "SELECT id, correct_option FROM questions WHERE exam_id = :exam_id";
$stmt = $pdo->prepare($query);
$stmt->execute(['exam_id' => $exam_id]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calculate the score
$score = 0;
$total_marks = count($questions);

foreach ($questions as $question) {
    $question_id = $question['id'];
    $correct_option = $question['correct_option'];

    if (isset($answers[$question_id]) && $answers[$question_id] == $correct_option) {
        $score++;
    }
}

try {
    // Insert or update the result in the exam_results table
    $query = "INSERT INTO exam_results (std_id, exam_id, score, completion_time)
              VALUES (:std_id, :exam_id, :score, NOW())
              ON DUPLICATE KEY UPDATE score = :score, completion_time = NOW()";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['std_id' => $std_id, 'exam_id' => $exam_id, 'score' => $score]);

    echo "Exam submitted successfully! Your score: $score / $total_marks";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
