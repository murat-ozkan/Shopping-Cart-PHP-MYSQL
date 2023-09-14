<?php

try {
    $db = new PDO("mysql:host=localhost;dbname=shopping-cart-db;charset=utf8", "tutorial", "supersecretpassword");
    echo "connection successful";
} catch (PDOException $e) {
    echo $e->getMessage();
    echo "connection failed";
}
