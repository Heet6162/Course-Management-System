<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .navbar {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
        }

        .container {
            padding: 20px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card h3 {
            margin: 0 0 10px;
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <h1>Admin Panel</h1>
        <div>
            <a href="manage_students.php">Students</a>
            <a href="manage_instructors.php">Instructors</a>
            <a href="manage_courses.php">Courses</a>
            <a href="manage_subjects.php">Subjects</a>
            <a href="manage_exams.php">Exams</a>
            <a href="manage_evaluations.php">Evaluations</a>
            <a href="manage_payments.php">Payments</a>
            <a href="manage_advisors.php">Advisors</a>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <h3>Welcome to the Admin Panel</h3>
            <p>Use the navigation bar above to manage different aspects of the system.</p>
        </div>
    </div>
</body>

</html>
