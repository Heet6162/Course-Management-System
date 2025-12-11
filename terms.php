<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #e0e0e0;
    }

    .container {
        background-color: #f2f2f2;
        width: 500%;
        max-width: 750px;
        padding: 50px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    .logo {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        background-color: #fff;
        border-radius: 50%;
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 40px;
    }

    .purple-bar {
        width: 70%;
        height: 20px;
        background-color: #a65cf0;
        border-radius: 10px;
        margin: 15px auto;
    }

    .terms {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
        font-size: 14px;
    }

    .terms input {
        margin-right: 10px;
    }

    button {
        margin-top: 20px;
        padding: 10px 20px;
        font-size: 16px;
        border: 1px solid #333;
        border-radius: 8px;
        cursor: pointer;
        background-color: #fff;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #ddd;
    }
</style>

<body>
    <div class="container">
        <div class="logo">Logo</div>
        <form method="post" action="home.php">
            <p>Make sure your attendance will be 100% at the end of semester</p>
            &nbsp;
            <p>Use only one account and keep your login details private.</p>
            &nbsp;
            <p>Use course materials only for personal study; do not copy or share without permission.</p>
            &nbsp;
            <p>Submit original work; no plagiarism or cheating.</p>
            &nbsp;
            <p>Participate honestly in exams.</p>
            &nbsp;
            <p>Use respectful language with peers and instructors.</p>
            &nbsp;
            <p>Do not try to hack or interfere with the CMS.</p>
            <!-- 
            <div class="purple-bar"></div> -->
            <div class="terms"><input type="checkbox" name="terms" required><label>Accept terms and conditions</label>
            </div><button type="submit" name="submit">Submit</button>
        </form>
    </div>
</body>

</html>