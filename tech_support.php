<?php
    require_once("db_stuff.php");

    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);

    if($_COOKIE['userRole'] == 'admin') 
    { 
        echo '<h1>Wybierz użytkownika</h1>';
        echo '
        <form action="?subpage=techsupport" method="post" class="user-select" style="display: flex; flex-direction: row;">
        <select name="userId" id="" style="width: 100%; height: 40px;>
        ';
        
        $users = $conn->query("SELECT id, username FROM users WHERE userrole='user'");
        
        while($row = $users->fetch_array())
    {
        echo '
        <option value="'.$row['id'].'">'.$row['username'].'</option>
        ';
    }
    
    echo '
    </select>
    <button type="submit" name="subpage" value="techsupport">Wybierz</button>
    </form>';
    }
?>

<div class="messages">

<?php

    $userId = $conn->query("SELECT id FROM users WHERE username='".$_COOKIE['userLoggedIn']."'")->fetch_assoc()['id'];

    $result = $conn->query("SELECT author_id, contents, message_time FROM messages WHERE recipient_id=$userId OR author_id=$userId");

    while($row = $result->fetch_assoc()) 
    {
    ?>    
        <div class="message <?php echo $row['author_id'] == $userId ? "user-message" : "response-message"; ?>">
            <p><?php echo $row['contents'] ?></p>
        </div>

    <?php
    }
?>

</div>

<form action="add_message.php" method="post">
    <input type="text" name="messageContents">
    <button type="submit">Wyślij</button>
</form>

<?php


    $conn->close();
?>