<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sold Products</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
        }

        .table-container {
            width: 80%;
            margin: 40px auto;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #007bff;
            color: white;
        }

        tr:hover {
            background: #f1f1f1;
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
 <?php
include "connection.php";

$type = (isset($_GET['type']) && $_GET['type'] != "") ? $_GET['type'] : 'day';

if ($type == "hour") {
    $sql = "SELECT * FROM soldproduct WHERE HOUR(time_sold)=HOUR(NOW())";
}
elseif ($type == "day") {
    $sql = "SELECT * FROM soldproduct WHERE DATE(time_sold)=CURDATE()";
}
elseif ($type == "month") {
    $sql = "SELECT * FROM soldproduct 
            WHERE MONTH(time_sold)=MONTH(CURDATE())
            AND YEAR(time_sold)=YEAR(CURDATE())";
}
elseif ($type == "year") {
    $sql = "SELECT * FROM soldproduct WHERE YEAR(time_sold)=YEAR(CURDATE())";
}
else {
    $sql = "SELECT * FROM soldproduct";
}

$result = mysqli_query($conn, $sql);
?>

<div class="table-container">
    <h2>Sold Products Report</h2>

    <!-- FILTER -->
    <select onchange="location=this.value">
        <option value="?type=day">Daily Report</option>
        <option value="?type=hour">Hourly Report</option>
        <option value="?type=month">Monthly Report</option>
        <option value="?type=year">Yearly Report</option>
    </select>

    <table border="1" width="100%">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Quantity</th>
                <th>Sold Price</th>
                <th>Total</th>
                
                <th>Customer Phone</th>
                <th>Time Sold</th>
            </tr>
        </thead>

        <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {

            $total = $row['quantity'] * $row['soldprice'];

            echo "<tr>
                <td>{$row['product_id']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['soldprice']}</td>
                <td>{$total}</td>
              
                <td>{$row['cu_phone']}</td>
                <td>{$row['time_sold']}</td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
        </table>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>