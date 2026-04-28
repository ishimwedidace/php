<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
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
    <h2>Registration Form</h2>
    <form method="POST" action="register.php">
        <label>Full Name:</label>
        <input type="text" name="fname" required>

        <label>Username:</label>
        <input type="text" name="username" required>

        <label>phone tel:</label>
        <input type="number" name="age" required>

        <label>password:</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button>
    </form>
</div>
 <?php
   include "connection.php";
  
    $fname = $_POST['fname'];
    $username = $_POST['username'];
    $age = $_POST['age'];
    $location = $_POST['password'];
        $sql = "INSERT INTO student (fname, username, phone, password)
            VALUES ('$fname', '$username', '$age', '$location')";
            $a=mysqli_query($conn, $sql);
            if($a){
                header("location:home.php");
            }
            else{
                echo 'not';
            }
    ?>
</body>
</html>
  