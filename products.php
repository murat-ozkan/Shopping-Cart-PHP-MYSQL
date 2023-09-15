<?php 
if(isset($_GET['action']) && $_GET['action']=="add"){ //If the GET variable called action is set and its value is add, we execute the code.
    $id=intval($_GET['id']); //We make sure that the id which is passed through the $_GET variable is an integer.
    
    if(isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++; //If the id of the product is already in the $_SESSION variable, we just increment the quantity by one.
    } else { 
        //! If the id is not in the session, we need to make sure that the id which is passed through the $_GET variable exists in the database. If it does, we grab the price and create its session. 

        $stmt = $mysqli->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        if(isset($result['id']) && $result['id']) {
            $_SESSION['cart'][$result['id']] = array(
                "quantity" => 1,
                "price" => $result['price']
            );
        } else { //! If it doesn't, we set a variable called $message which stores the error message.
            $message="This product id is invalid!";
        }            
    }
} 
?>

<h1>Product List</h1>

<?php 
    if(isset($message)) { 
        echo "<h2>$message</h2>";
    }
?> 

<table> 
    <tr> 
        <th>Name</th> 
        <th>Description</th> 
        <th>Price</th> 
        <th>Action</th> 
    </tr> 
    <?php
        $sql="SELECT * FROM products ORDER BY name ASC"; 
        $result = $mysqli->query($sql);
      
        while ($row = $result->fetch_assoc()) {
    ?>
            <tr> 
                <td><?php echo $row['name'] ?></td> 
                <td><?php echo $row['description'] ?></td> 
                <td><?php echo $row['price'] ?>$</td> 
                <td><a href="index.php?page=products&action=add&id=<?php echo $row['id_product'] ?>">Add to cart</a></td> 
            </tr>
    <?php
        } 
    ?> 
</table>