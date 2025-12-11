<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select a Course</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #444;
        }

        form {
            width: 100%;
        }

        label {
            font-size: 16px;
            margin-bottom: 10px;
            display: block;
            text-align: left;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-button {
            margin-top: 20px;
            background-color: #6c757d;
        }

        .back-button:hover {
            background-color: #5a6268;
        }

        @media (max-width: 600px) {
            .container {
                width: 90%;
            }

            button {
                width: 100%;
                padding: 12px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Select a Course</h1>
        <form action="test.php" method="GET">
            <label for="course">Choose a course:</label>
            <select name="course_id" id="course">
                <?php
                // Database connection
                $conn = new mysqli('localhost', 'root', '', 'cms');
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch courses to populate dropdown
                $result = $conn->query("SELECT DISTINCT course_id, course_name FROM course");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['course_id']}'>{$row['course_name']}</option>";
                }
                $conn->close();
                ?>
            </select>
            <button type="submit">View Course Details</button>
        </form>
        <button class="back-button" onclick="window.location.href='home.php'">Back to Home</button>
    </div>

</body>

</html>