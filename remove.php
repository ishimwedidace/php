<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Management System</title>

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
    <input type="number" step="0.01" name="quantity" placeholder="Quantity   Kg" required>
    <input type="number" step="0.01" name="soldprice" placeholder="Price per Kg" required>
    <input type="tel" name="cu_phone" placeholder="Customer Phone" required>
    <button type="submit">Sell</button>
</form>
</div><?php
include "connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $product_id = $_POST['product_id'];
    $quantity   = (float) $_POST['quantity'];
    $selling_price = (float) $_POST['soldprice'];
    $cu_phone   = $_POST['cu_phone'];

  
    $result = mysqli_query($conn, "SELECT * FROM stock WHERE id='$product_id'");
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("❌ Product not found");
    }

    $available   = (float) $row['quantity'];
    $cost_price  = (float) $row['buyprice']; 

    if ($quantity > $available) {
        die("❌ Not enough stock");
    }


    $total_amount = $quantity * $selling_price;
    $total_cost   = $quantity * $cost_price;
    $profit       = $total_amount - $total_cost;

    
    $insert = "INSERT INTO soldproduct 
    (product_id, quantity, soldprice, cu_phone, time_sold)
    VALUES 
    ('$product_id', '$quantity', '$selling_price', '$cu_phone', NOW())";

    if (!mysqli_query($conn, $insert)) {
        die("❌ Insert failed: " . mysqli_error($conn));
    }


    $new_quantity = $available - $quantity;

    if ($new_quantity <= 0) {
        mysqli_query($conn, "DELETE FROM stock WHERE id='$product_id'");
    } else {
        mysqli_query($conn, "UPDATE stock SET quantity=$new_quantity WHERE id='$product_id'");
    }
$color = ($profit >= 0) ? "green" : "red";
  echo "
<div style='
    width:300px;
    margin:20px auto;
    padding:20px;
    border-radius:10px;
    background:#f4f6f9;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    font-family:Arial;
'>

    <h3 style='text-align:center; color:green;'>✅ Sale Recorded</h3>

    <p><strong>Quantity:</strong> $quantity</p>
    <p><strong>Total Sold:</strong> $total_amount Frw</p>
    <p><strong>Total Cost:</strong> $total_cost Frw</p>
 <p><strong>Profit:</strong> <span style='color:$color;'>$profit Frw</span></p>

</div>
";
}
?>
<?php include "footer.php"; ?>

</body>
</html>