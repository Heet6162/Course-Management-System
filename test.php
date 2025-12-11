<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            width: 80%;
            max-width: 600px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #444;
        }

        p {
            font-size: 16px;
            margin: 10px 0;
        }

        strong {
            color: black;
        }

        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        @media (max-width: 600px) {
            .container {
                width: 90%;
            }

            .btn {
                width: 100%;
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // Check if course_id is set
        if (isset($_GET['course_id'])) {
            $course_id = intval($_GET['course_id']);

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'cms');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT 
            i.instructorname AS instructor_name,
            s.subname AS subject_name,
            a.advisorname AS advisor_name,
            c.course_credit AS course_credit
            FROM 
                instructor_data AS id
            JOIN 
                instructor AS i ON id.instructor_id = i.instructor_id
            JOIN 
                subject AS s ON id.sub_id = s.sub_id
            JOIN 
                advisor AS a ON id.advisor_id = a.advisor_id
            JOIN
                course AS c ON id.course_id = c.course_id
            WHERE 
                id.course_id = ?";

            // Prepare and execute statement
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $course_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if results exist
            if ($result->num_rows > 0) {
                echo "<h1>Course Details</h1>";
                while ($row = $result->fetch_assoc()) {
                    echo "<p><strong>Instructor:</strong> {$row['instructor_name']}</p>";
                    echo "<p><strong>Subject:</strong> {$row['subject_name']}</p>";
                    echo "<p><strong>Course Credit:</strong> {$row['course_credit']}</p>";
                    echo "<p><strong>Advisor:</strong> {$row['advisor_name']}</p>";
                }
            } else {
                echo "<p>No details found for the selected course.</p>";
            }

            // Close connection
            $stmt->close();
            $conn->close();
        } else {
            echo "<p>No course selected. Please go back and choose a course.</p>";
        }
        ?>
    </div>
    <div class="container">
        <form action="payment.php" method="GET">
            <input type="hidden" name="course_id" value="<?php echo $course_id; ?>" />
            <button class="btn" type="submit">Proceed to Payment</button>
        </form>
        <button class="btn btn-secondary" onclick="window.location.href='home.php'">Back to Home</button>
    </div>
</body>

</html>