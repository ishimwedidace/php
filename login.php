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
.create-account {
    text-decoration: none;
    color: #007BFF;
    font-weight: bold;
    margin-left: 180px;
}

.create-account:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>

<div class="form-container">
    <h2>Login Form</h2>
    <form method="POST" action="login.php">
        <label>Username:</label>
        <input type="text" name="user" required>
        <label>password:</label>
        <input type="pasword" name="pass" required>
        <button type="submit">login</button>
    </form>
  <a href="register.php" class="create-account">create account</a>
</div>
<?php
include "connection.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['user'];
    $password = $_POST['pass'];

    // Prepare statement
    $stmt = $conn->prepare("SELECT * FROM student WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify hashed password
        if (password_verify($password, $row['password'])) {

            $_SESSION['username'] = $row['username'];

            header("Location: home.php");
            exit();

        } else {
            echo "Wrong password";
        }

    } else {
        echo "User not found";
    }

    $stmt->close();
    $conn->close();
}
?>


</body>
</html>