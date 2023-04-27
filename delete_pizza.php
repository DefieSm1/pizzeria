<?php

    require_once("db_stuff.php");

    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);

    $pizzaId = $_POST['pizzaId'];

    $conn->query("UPDATE pizzas SET pizzadisabled=true WHERE id=$pizzaId");

    $conn->close();
    header("Location: main_page.php?subpage=pizzamanage");
    exit;
?>