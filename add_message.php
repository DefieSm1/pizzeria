<?php
    require_once("db_stuff.php");

    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);

    $messageContents = $_POST['messageContents'];

    $userId = $conn->query("SELECT id FROM users WHERE username='".$_COOKIE['userLoggedIn']."'")->fetch_assoc()['id'];

    $conn->query("INSERT INTO messages(author_id, recipient_id, contents) VALUES ($userId, 1, '$messageContents')");

    $conn->close();
    header("Location: main_page.php?subpage=techsupport");
    exit;
?>