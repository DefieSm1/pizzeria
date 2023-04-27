<?php
    require_once("db_stuff.php");
    
    $newUsername = $_POST['newUsername'] ?? NULL;
    $newEmail = $_POST['newEmail'] ?? NULL;
    $newPassword = $_POST['newPassword'] ?? NULL;
    $newPasswordConfirm = $_POST['newPasswordConfirm'] ?? NULL;
    $oldPassword = $_POST['oldPassword'] ?? NULL;

    $newValues = [];

    if(isset($newUsername)) {
        array_push($newValues, "username='$newUsername'");
    }

    $newHash = '';

    if(isset($newPassword) && $newPassword == $newPasswordConfirm) {
        echo caesarShift($newPassword, 3);
        $newHash = password_hash(caesarShift($newPassword, 3), PASSWORD_DEFAULT);
        array_push($newValues, "pass='$newHash'");
    }

    if(isset($newEmail)) {
        array_push($newValues, "email='$newEmail'");
    }

    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);
    
    if ($conn->connect_error)
        exit("Connection failed: " . $conn->connect_error);

    $cipheredPass = caesarShift($oldPassword, 3);

    $currentUsername = $_COOKIE['userLoggedIn'];

    $dbPass = $conn->query("SELECT pass FROM users WHERE username='$currentUsername'")->fetch_assoc()['pass'];

    if(!password_verify($cipheredPass, $dbPass) || count($newValues) == 0) {
        header("Location: user_info.php?msg=chngErr");
        exit;
    }

    $updatedValues = implode(", ", $newValues);
    echo $newHash;
    echo $updatedValues;
    $conn->query("UPDATE users SET $updatedValues WHERE username='$currentUsername'");

    $conn->close();
    header("Location: logout.php");
    exit;
?>