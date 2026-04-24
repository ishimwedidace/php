<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product Form</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .form-container {
            width: 350px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 2px solid #0c0b0b;
            text-align: center;
        }

        button {
            width: 40%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
     <?php include "header.php"; ?>
<a href="home.php" style="
    display:inline-block;
    padding:10px 15px;
    background:#007bff;
    color:white;
    text-decoration:none;
    border-radius:5px;
">
⬅ Back
</a>
<div class="form-container">
    <h2>Add Product</h2>

    <form method="POST">
        <input type="text" name="name" placeholder="name" required>

        <input type="number" step="0.01" name="buyprice" placeholder="buy price" required>

        <input type="number" step="0.01" name="sellprice" placeholder="sell price" required>

        <input type="number" name="quantity" placeholder="quantity" required>

        <center><button type="submit">Add Product</button></center>
    </form>
</div>

<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $buyprice = $_POST['buyprice'];
    $sellprice = $_POST['sellprice'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO stock (name, buyprice, sellprice, quantity)
            VALUES ('$name', '$buyprice', '$sellprice', '$quantity')";

    $a = mysqli_query($conn, $sql);

    if ($a) {
        header("Location: home.php");
        exit();
    } else {
        echo "Not inserted: " . mysqli_error($conn);
    }
}
?>
    <?php include "footer.php"; ?>
</body>
</html>