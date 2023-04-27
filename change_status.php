<?php
    require_once("db_stuff.php");

    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);

    $userId = $conn->query("SELECT id FROM users WHERE username='".$_COOKIE['userLoggedIn']."'")->fetch_assoc()['id'];

    $orderId = $_POST['order'];
    $newStatus = $_POST['status'];

    $currentStatus = $conn->query("SELECT orderstatus FROM orders WHERE id=$orderId")->fetch_assoc()['orderstatus'];

    if($currentStatus != $newStatus)
    {
        $conn->query("UPDATE orders SET orderstatus='$newStatus', lastchange=NOW() WHERE id=$orderId");
        $conn->query("INSERT INTO order_history(order_id, old_status, new_status, change_time) VALUES('$orderId', '$currentStatus', '$newStatus', now())");
    }

    $conn->close();
    header("Location: main_page.php?subpage=ordermanage");
    exit;
?>