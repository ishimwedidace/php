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
    <input type="number" step="0.01" name="quantity" placeholder="Kg" required>
    <input type="number" step="0.01" name="soldprice" placeholder="Price per Kg" required>
    <input type="tel" name="cu_phone" placeholder="Customer Phone" required>
    <button type="submit">Sell</button>
</form>
</div>
<?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_id = $_POST['product_id'];
    $quantity   = $_POST['quantity'];      
    $price      = $_POST['soldprice'];     
    $cu_phone   = $_POST['cu_phone'];

  
    $total = $quantity * $price;

    $result = mysqli_query($conn, "SELECT * FROM stock WHERE id='$product_id'");
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("❌ Product not found");
    }

    $available = $row['quantity'];

    // ❗ Prevent overselling
    if ($quantity > $available) {
        die("❌ Not enough stock. Available: $available kg");
    }

    // 1️⃣ Save sale
    $insert = "INSERT INTO soldproduct 
    (product_id, quantity,soldprice, cu_phone, time_sold)
    VALUES 
    ('$product_id', '$quantity', '$price', '$cu_phone', NOW())";

    if (!mysqli_query($conn, $insert)) {
        die("❌ Insert failed: " . mysqli_error($conn));
    }

    // 2️⃣ Reduce stock
    $update = "UPDATE stock 
               SET quantity = quantity - $quantity 
               WHERE id='$product_id'";

    if (!mysqli_query($conn, $update)) {
        die("❌ Update failed: " . mysqli_error($conn));
    }

    // 3️⃣ Optional: remove if empty
    mysqli_query($conn, "DELETE FROM stock WHERE id='$product_id' AND quantity <= 0");

    echo "
    <h3 style='color:green;'>✔ Sale completed</h3>
    <p>Sold: $quantity kg</p>
    <p>Price per kg: $price</p>
    <p><strong>Total: $total</strong></p>
    ";
}
?>

<?php include "footer.php"; ?>

</body>
</html>