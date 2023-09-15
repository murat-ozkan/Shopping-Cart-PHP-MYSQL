<?php
// session_start(); // for later use

require "./includes/connection.php";

if (isset($_GET['page'])) {
    $pages = array("products", "cart");

    if (in_array($_GET['page'], $pages)) {
        $_page = $_GET['page'];
    } else {
        $_page = "products";
    }
} else {
    $_page = "products";
}

//! Alternative Way to query
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
            <?php require($_page . ".php"); ?>
            <!-- <h1>Product List</h1> -->
            <!-- 
            <table> //! This table part moved to products.php
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr> -->

            <!-- <?php //! Alternative Way
                    // while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    //     echo "<tr>";
                    //     echo "<td>" . $row['name'] . "</td>";
                    //     echo "<td>" . $row['description'] . "</td>";
                    //     echo "<td>" . $row['price'] . "</td>";
                    //     echo "</tr>";
                    // }
                    ?> -->


            <?php /*
                $query = "SELECT * FROM products ORDER BY name ASC";
                $result = $mysqli->query($query);

                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['description'] ?></td>
                        <td><?php echo $row['price'] ?>$</td>
                        <td><a href="index.php?page=products&action=add&id=
                        <?php echo $row['id'] ?>">Add to cart</a></td>
                    </tr>
                <?php
                }*/
            ?>

            <!-- <tr> //? To Try default design
                    <td>Product 1</td>
                    <td>Description</td>
                    <td>15$</td>
                    <td><a href="#">Add To Cart</a></td>
                </tr>
                <tr>
                    <td>Product 2</td>
                    <td>Description</td>
                    <td>150$</td>
                    <td><a href="#">Add To Cart</a></td>
                </tr> -->
            </table>

        </div>
        <div id="sidebar"></div>
    </div>
</body>

</html>