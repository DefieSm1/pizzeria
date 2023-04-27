<?php 
    session_start();

    require_once('db_stuff.php');

    $chosenPizza = $_POST['pizza'];

    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error)
        exit("Connection failed: " . $conn->connect_error);

    $customerName = $_COOKIE['userLoggedIn'];

    $customerId = $conn->query("SELECT id FROM users WHERE username='$customerName'")->fetch_assoc()['id'];

    $conn->query("INSERT INTO orders(customer, pizza, orderstatus) VALUES ('$customerId', $chosenPizza, 'Zakupiona')");

    $orderId = $conn->query("SELECT id FROM orders WHERE customer='".$customerId."' AND id=(SELECT MAX(id) FROM orders)")->fetch_array()['id'];

    $conn->query("INSERT INTO order_history(order_id, old_status, new_status, change_time) VALUES ($orderId, '', 'Zakupiona', now())");

    $conn->close();

    header("Location: main_page.php");
    exit;
?>