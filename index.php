<?php
session_start();

require "./includes/connection.php";
// Connection settings for the MYSQL database

if (isset($_GET['page'])) { // "href="index.php?page=products&action=add&id=" sends "$page"
    $pages = array("products", "cart");
    if (in_array($_GET['page'], $pages)) {
        $_page = $_GET['page'];
    } else {
        $_page = "products";
    }
} else {
    $_page = "products";
}

// Alternative Way to query
// $query = $db->prepare("select * from products");
// $query->execute();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Shopping Cart</title>
</head>

<body>
    <div id="container">
        <div id="main">
            <?php require($_page . ".php"); ?> <!-- calls the products.php in index.php -->
        </div>
        <div id="sidebar">
            <h1>Cart</h1>

            <?php
            if (isset($_SESSION["cart"])) {
                $arrProductIds = array();

                foreach ($_SESSION["cart"] as $id => $value) {
                    $arrProductIds[] = $id;
                }
                $strIds = implode(",", $arrProductIds);

                $stmt = $mysqli->prepare("SELECT * FROM products WHERE id IN (?)");
                $stmt->bind_param("s", $strIds);
                $stmt->execute();
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
            ?>
                    <p><?php echo $row['name'] ?> x <?php echo $_SESSION['cart'][$row['id']]['quantity'] ?></p>
                <?php
                }
                ?>
                <hr />
                <a href="index.php?page=cart">Go to cart</a>
            <?php

            } else {
                echo "<p>Your Cart is empty. Please add some products.</p>";
            }

            ?>
        </div>
    </div>
</body>

</html>