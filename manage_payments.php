<?php
include 'include/db.php'; // Database connection

// Fetch all payments
$sql = "
    SELECT p.pay_id, c.course_name, p.amount, p.paymentdate
    FROM payments p
    JOIN course c ON p.course_id = c.course_id
";
$result = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Payments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: white;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin: 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Manage Payments</h1>

    <!-- Payments Table -->
    <table>
        <thead>
            <tr>
                <th>Payment ID</th>
                <th>Course Name</th>
                <th>Amount</th>
                <th>Payment Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['pay_id']); ?></td>
                    <td><?php echo htmlspecialchars($row['course_name']); ?></td>
                    <td>$<?php echo htmlspecialchars(number_format($row['amount'], 2)); ?></td>
                    <td><?php echo htmlspecialchars($row['paymentdate']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>

</html>