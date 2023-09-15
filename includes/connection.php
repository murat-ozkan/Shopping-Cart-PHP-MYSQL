<?php

// try {
//     $db = new PDO("mysql:host=localhost;dbname=shopping-cart-db;charset=utf8", "tutorial", "supersecretpassword");
//     echo "connection successful";
// } catch (PDOException $e) {
//     echo $e->getMessage();
//     echo "connection failed";
// }
?>

<?php
$server = "localhost";
$user = "tutorial";
$pass = "supersecretpassword";
$db = "shopping-cart-db";

//Bu nesne, MySQL veritabanına bağlanmayı ve veritabanı işlemlerini gerçekleştirmeyi sağlar.
$mysqli = new mysqli($server, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Sorry, can't connect to the mysql.");
} else {
    // echo "succesfully connected";
}
?>