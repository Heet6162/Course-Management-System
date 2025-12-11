<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eef2f7;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 600px;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        h1 {
            text-align: center;
            font-size: 24px;
            color: black;
            margin-bottom: 20px;
        }

        .payment-details {
            margin-bottom: 20px;
        }

        .payment-details p {
            font-size: 16px;
            margin: 8px 0;
        }

        .payment-details p strong {
            color: black;
        }

        form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .form-group input:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px 20px;
            font-size: 18px;
            font-weight: bold;
            color: white;
            background-color: #28a745;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background-color: #218838;
            transform: scale(1.02);
        }

        .home-button {
            background-color: #6c757d;
            color: white;
            margin-top: 10px;
            padding: 10px 30px;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .home-button:hover {
            background-color: #5a6268;
            transform: scale(1.02);
        }

        .home-button:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // Check if course_id is passed
        if (isset($_GET['course_id'])) {
            $course_id = intval($_GET['course_id']);

            // Database connection
            $conn = new mysqli('localhost', 'root', '', 'cms');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch course details and amount
            $sql = "SELECT 
                        c.course_name,
                        i.instructorname AS instructor_name,
                        s.subname AS subject_name,
                        a.advisorname AS advisor_name,
                        c.course_credit AS course_credit,
                        c.amount AS course_amount
                    FROM 
                        course AS c
                    JOIN 
                        instructor_data AS id ON id.course_id = c.course_id
                    JOIN 
                        instructor AS i ON id.instructor_id = i.instructor_id
                    JOIN 
                        subject AS s ON id.sub_id = s.sub_id
                    JOIN 
                        advisor AS a ON id.advisor_id = a.advisor_id
                    WHERE c.course_id = ?";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $course_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $course_details = $result->fetch_assoc();
                echo "<h1>Payment Details for {$course_details['course_name']}</h1>";
                echo "<div class='payment-details'>";
                echo "<p><strong>Instructor:</strong> {$course_details['instructor_name']}</p>";
                echo "<p><strong>Subject:</strong> {$course_details['subject_name']}</p>";
                echo "<p><strong>Advisor:</strong> {$course_details['advisor_name']}</p>";
                echo "<p><strong>Course Credit:</strong> {$course_details['course_credit']}</p>";
                echo "<p><strong>Amount:</strong> ₹{$course_details['course_amount']}</p>";

                // Display the payment form
                echo "<form action='process_payment.php' method='POST'>";
                echo "<div class='form-group'>";
                echo "<label for='card_number'>Credit Card Number:</label>";
                echo "<input type='text' name='card_number' id='card_number' required />";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='expiry_date'>Expiry Date:</label>";
                echo "<input type='text' name='expiry_date' id='expiry_date' required />";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='cvv'>CVV:</label>";
                echo "<input type='text' name='cvv' id='cvv' required />";
                echo "</div>";
                echo "<input type='hidden' name='course_id' value='{$course_id}' />"; // Hidden field for course_id
                echo "<input type='hidden' name='course_amount' value='{$course_details['course_amount']}' />"; // Hidden field for course amount
                echo "<button type='submit'>Submit Payment</button>";
                echo "</form>";

                // Add the Back to Home button directly below
                echo "<button class='home-button' onclick=\"window.location.href='home.php'\">Back to Home</button>";
                echo "</div>";
            } else {
                echo "<p>No course details found.</p>";
            }

            // Close connection
            $stmt->close();
            $conn->close();
        } else {
            echo "<p>No course selected for payment.</p>";
        }
        ?>
    </div>
</body>

</html>