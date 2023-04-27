<?php 
    require_once('db_stuff.php');

    $userName = $_POST['username'];
    $userPass = $_POST['password'];
    
    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);
    
    if ($conn->connect_error)
        exit("Connection failed: " . $conn->connect_error);
    
    if($conn->query("SELECT * FROM users WHERE username='$userName'")->num_rows == 0) {
        header("Location: index.php?msg=logInv");
        $conn->close();
        exit;
    }

    $userPass = caesarShift($userPass, 3);

    $dbPass = $conn->query("SELECT pass FROM users WHERE username='$userName'")->fetch_assoc()['pass'];

    if(password_verify($userPass, $dbPass)) {
        // $_SESSION['loggedInUser'] = $userName;
        // $_SESSION['userRole'] = $conn->query("SELECT userrole FROM users WHERE username='$userName'")->fetch_assoc()['userrole'];
        $userRole = $conn->query("SELECT userrole FROM users WHERE username='$userName'")->fetch_assoc()['userrole'];
        setcookie("userLoggedIn", $userName);
        setcookie("userRole", $userRole);
        $conn->close();
        header("Location: index.php");
        exit;
    }
    else {
        $conn->close();
        header("Location: index.php?msg=logInv");
        exit;
    }
?>