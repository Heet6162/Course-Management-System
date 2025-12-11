<?php
// Start the session to use session variables
session_start();

// Database connection
$servername = "localhost";  // Database server
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "cms";             // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure course_id is set in the URL
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];  // Get the course_id from URL
} else {
    die("Course ID is required.");
}

// Query to fetch the details from the database based on course_id
$sql = "
    SELECT 
        c.course_name, 
        s.subname, 
        i.instructorname, 
        a.advisorname, 
        p.amount  
    FROM 
        course c
    JOIN 
        subject s ON c.sub_id = s.id
    JOIN 
        instructor i ON c.instructor_id = i.id
    JOIN 
        advisor a ON c.advisor_id = a.id
    JOIN 
        payment p ON c.pay_id = p.id
    WHERE 
        c.course_id = 31;
";

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

// Execute the query
$stmt->execute();

// Bind the result variables
$stmt->bind_result($course_name, $subject_name, $instructor_name, $advisor_name, $payment_amount);

// Fetch the result
if ($stmt->fetch()) {
    // Successfully fetched data
    echo $course_name;  // Display or process the data as needed
} else {
    echo "No course found with ID 31.";
}
$stmt->close();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proceed Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 60%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .details {
            margin-bottom: 20px;
        }

        .details p {
            font-size: 18px;
            color: #555;
        }

        .details p strong {
            color: #333;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Proceed to Payment</h1>

        <!-- Course Details -->
        <div class="details">
            <p><strong>Course Name:</strong> <?php echo htmlspecialchars($course_name); ?></p>
            <p><strong>Subject Name:</strong> <?php echo htmlspecialchars($subject_name); ?></p>
            <p><strong>Instructor Name:</strong> <?php echo htmlspecialchars($instructor_name); ?></p>
            <p><strong>Advisor Name:</strong> <?php echo htmlspecialchars($advisor_name); ?></p>
            <p><strong>Payment Amount:</strong> $<?php echo number_format($payment_amount, 2); ?></p>
        </div>

        <!-- Proceed Button -->
        <form action="payment.php" method="POST">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
            <button type="submit" class="btn">Proceed to Payment</button>
        </form>
    </div>

</body>

</html>