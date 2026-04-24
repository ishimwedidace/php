<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<?php
include "connection.php";

$sql_profit = "SELECT 
            s.name,
            s.buyprice,
            sp.soldprice,
            sp.quantity,
            (s.buyprice * sp.quantity) AS total_cost,
            (sp.soldprice * sp.quantity) AS total_sales,
            ((sp.soldprice * sp.quantity) - (s.buyprice * sp.quantity)) AS profit
        FROM stock s
        INNER JOIN soldproduct sp
        ON s.id = sp.product_id
        WHERE (sp.soldprice * sp.quantity) > (s.buyprice * sp.quantity)";

$result_profit = mysqli_query($conn, $sql_profit);
?>

<style>
.container {
    width: 90%;
    margin: auto;
    margin-top: 30px;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0,0,0,0.1);
    font-family: Arial;
}

h2 {
    text-align: center;
    color: #28a745;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th, td {
    padding: 10px;
    text-align: center;
    border: 1px solid #ddd;
}

th {
    background: #28a745;
    color: white;
}

tr:nth-child(even) {
    background: #f9f9f9;
}

.profit {
    color: green;
    font-weight: bold;
}
</style>

<div class="container">

    <h2>💰 Profit Report</h2>

    <table>
        <tr>
            <th>Product</th>
            <th>Buy Price</th>
            <th>Sell Price</th>
            <th>Quantity</th>
            <th>Total Cost</th>
            <th>Total Sales</th>
            <th>Profit</th>
        </tr>

        <?php
        while ($row = mysqli_fetch_assoc($result_profit)) {
            echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['buyprice']}</td>
                <td>{$row['soldprice']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['total_cost']}</td>
                <td>{$row['total_sales']}</td>
                <td class='profit'>{$row['profit']}</td>
            </tr>";
        }
        ?>

    </table>

</div>

      <?php include "footer.php"; ?>
</body>
</html>