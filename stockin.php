<!DOCTYPE html>
<html>
<head>
    <title>Stock Table</title>
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

<h2 style="text-align:center;">Stock List</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Buy Price</th>
        <th>Sell Price</th>
        <th>Quantity</th>
    </tr>

    <?php
    include "connection.php";
    $sql = "SELECT id, name, buyprice, sellprice, quantity FROM stock";
$result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['buyprice']}</td>
                    <td>{$row['sellprice']}</td>
                    <td>{$row['quantity']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No stock available</td></tr>";
    }
    ?>

</table>
  <?php include "footer.php"; ?>
</body>
</html>