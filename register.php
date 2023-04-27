<?php 
    require_once('db_stuff.php');

    $userName = $_POST['username'];
    $userPass = $_POST['password'];
    $userConfirmPass = $_POST['confirmPassword'];
    $userEmail = $_POST['email'];
    
    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);
    
    if ($conn->connect_error)
        exit("Connection failed: " . $conn->connect_error);

    if($userPass != $userConfirmPass) {
        header("Location: index.php?msg=diffPass");
        exit;
    }

    if($conn->query("SELECT * FROM users WHERE username='$userName' OR email='$userEmail'")->num_rows > 0) {
        header("Location: index.php?msg=userExst");
        exit;
    }

    $userPass = caesarShift($userPass, 3);
    $hashedPass = password_hash($userPass, PASSWORD_DEFAULT);

    $conn->query("INSERT INTO users(username, pass, email) VALUES ('$userName', '$hashedPass', '$userEmail')");

    $conn->close();

    header("Location: index.php?msg=regSc");
    exit;
?>