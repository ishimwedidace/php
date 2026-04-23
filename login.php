<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }
        .form-container {
            width: 300px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border: 5 solid black;
        }
        input {
            width: 85%;
            padding: 8px;
            margin: 8px 0;
            border-radius: 6px;
            border: 5 solid black;
            align-items: center;
        }
        button {
            width: 50%;
            padding: 10px;
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
                align-items: center;
                   border-radius: 6px;
        }
        button:hover {
            background: #0056b3;
            
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Login Form</h2>
    <form method="POST" action="">
        <label>Username:</label>
        <input type="text" name="user" required>
        <label>password:</label>
        <input type="pasword" name="pass" required>
        <button type="submit">login</button>
    </form>
</div>
<?php
include "connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $a = $_POST['user'];
    $b = $_POST['pass'];

    $stmt = $conn->prepare("SELECT * FROM student WHERE username=?");
    $stmt->bind_param("s", $a);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row && password_verify($b, $row['password'])) {

        $_SESSION['username'] = $a;
        header("Location: home.php");
        exit();

    } else {
        echo "Invalid login";
    }
}
?>


</body>
</html>