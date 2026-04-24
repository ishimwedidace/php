<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sell Product</title>

    <style>
        body {
            font-family: Arial;
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

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 2px solid #000;
            text-align: center;
        }

        button {
            width: 50%;
            padding: 10px;
            background: red;
            color: white;
            border: none;
            cursor: pointer;
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
    <h2>Sell Product</h2>
<form action="remove.php" method="POST">

    <input type="number" name="product_id" placeholder="Product ID" required>

    <input type="number" name="quantity" placeholder="Quantity Sold" required>

    <input type="text" name="soldprice" placeholder="Sold Price" required>

    <input type="text" name="cu_name" placeholder="Customer Name" required>

    <input type="tel" name="cu_phone" placeholder="Customer Phone" required>

    <button type="submit">Sell Product</button>

</form>
</div>

<?php
include "connection.php";

$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];
$soldprice = $_POST['soldprice'];
$cu_name = $_POST['cu_name'];
$cu_phone = $_POST['cu_phone'];

/* =========================
   1. GET PRODUCT FROM STOCK
   ========================= */
$get = mysqli_query($conn, "SELECT * FROM stock WHERE id='$product_id'");
$row = mysqli_fetch_assoc($get);

$name = $row['name'];

/* =========================
   2. INSERT INTO SOLDPRODUCT
   ========================= */
$sql = "INSERT INTO soldproduct 
(name, quantity, soldprice, cu_name, cu_phone, product_id, time_sold)
VALUES 
('$name', '$quantity', '$soldprice', '$cu_name', '$cu_phone', '$product_id', NOW())";

mysqli_query($conn, $sql);

/* =========================
   3. REMOVE FROM STOCK
   ========================= */
$delete = "DELETE FROM stock WHERE id='$product_id'";
mysqli_query($conn, $delete);

echo "✔ Product sold and removed from stock successfully!";
?>
    <?php include "footer.php"; ?>
</body>
</html>