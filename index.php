<?php
// session_start(); // for later use

require "./includes/connection.php";

$query = $db->prepare("select * from products");
$query->execute();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/includes/style.css" />
    <title>Shopping Cart</title>
</head>

<body>
    <div id="container">
        <div id="main">
            <h1>Product List</h1>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
                <?php
                while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "</tr>";
                }
                ?>




                <tr>
                    <td>Product 1</td>
                    <td>Description</td>
                    <td>15$</td>
                    <td><a href="#">Add To Cart</a></td>
                </tr>
            </table>
        </div>
        <div id="sidebar"></div>
    </div>
</body>

</html>