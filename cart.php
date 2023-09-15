<?php
if (isset($_POST['submit'])) {
    foreach ($_POST['quantity'] as $key => $val) {
        if ($val == 0) {
            unset($_SESSION['cart'][$key]);
        } else {
            $_SESSION['cart'][$key]['quantity'] = $val;
        }
    }
}
?>

<h1>View cart</h1>
<a href="index.php?page=products">Go back to the products page.</a>
<form method="post" action="index.php?page=cart">
    <table>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Items Price</th>
        </tr>
        <?php
        $arrProductIds = array();
        foreach ($_SESSION['cart'] as $id => $value) {
            $arrProductIds[] = $id;
        }
        $strIds = implode(",", $arrProductIds);
        $stmt = $mysqli->prepare("SELECT * FROM products WHERE id IN (?)");
        $stmt->bind_param("s", $strIds);
        $stmt->execute();
        $result = $stmt->get_result();
        $totalprice = 0;
        while ($row = $result->fetch_assoc()) {
            $subtotal = $_SESSION['cart'][$row['id']]['quantity'] * $row['price'];
            $totalprice += $subtotal;
        ?>
            <tr>
                <td><?php echo $row['name'] ?></td>
                <td><input type="text" name="quantity[<?php echo $row['id'] ?>]" size="5" value="<?php echo $_SESSION['cart'][$row['id']]['quantity'] ?>" /></td>
                <td><?php echo $row['price'] ?>$</td>
                <td><?php echo $_SESSION['cart'][$row['id']]['quantity'] * $row['price'] ?>$</td>
            </tr>
        <?php
        }
        ?>
        <tr>
            <td colspan="4">Total Price: <?php echo $totalprice ?></td>
        </tr>
    </table>
    <br />
    <button type="submit" name="submit">Update Cart</button>
</form>
<br />
<p>To remove an item set its quantity to 0. </p>