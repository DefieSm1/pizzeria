<?php
    require_once("db_stuff.php");

    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);

    $pizzaName = $_POST['pizzaName'];
    $pizzaDescription = $_POST['pizzaDescription'];
    $pizzaPrice = $_POST['pizzaPrice'];

    $conn->query("INSERT INTO pizzas(pizzaname, pizzadescription, price) VALUES ('$pizzaName', '$pizzaDescription', $pizzaPrice)");

    $conn->close();
    header("Location: main_page.php?subpage=pizzamanage");
    exit;
?>