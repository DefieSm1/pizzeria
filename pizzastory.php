<?php
    require_once("db_stuff.php");

    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);

    $userId = $conn->query("SELECT id FROM users WHERE username='".$_COOKIE['userLoggedIn']."'")->fetch_array()['id'];

    $result = $conn->query("SELECT orders.orderstatus, orders.lastchange, pizzas.pizzaname, pizzas.price FROM orders JOIN pizzas 
                            ON orders.pizza=pizzas.id WHERE orders.customer='".$userId."' AND NOT orders.orderstatus='Odebrana'");

    $pizzaPriceSum = 0;

    echo '<div class="current-orders">';
    echo '<h2>AKTUALNE ZAMÓWIENIA</h2>';
    echo '<table>';
    echo '
        <tr>
            <th>PIZZA</th>
            <th>STATUS</th>
            <th>OSTATNIA ZMIANA</th>
            <th>CENA</th>
        </tr>
    ';
    while($row = $result->fetch_array())
    {
        $pizzaPriceSum += $row['price'];
        echo '    
            <tr>
                <td>'.$row['pizzaname'].'</td>
                <td>'.$row['orderstatus'].'</td>
                <td>'.$row['lastchange'].'</td>
                <td>'.$row['price'].'zł</td>
            </tr>
        ';
    }
    echo '
        <tr class="history-price-sum">
            <td colspan="3">Suma zakupów</td>
            <td>'.$pizzaPriceSum.'zł</td>
        </tr>
    ';

    echo '</table>';
    echo '</div>';

    $result = $conn->query("SELECT orders.orderstatus, pizzas.pizzaname, pizzas.price FROM orders JOIN pizzas 
                            ON orders.pizza=pizzas.id WHERE orders.customer='".$userId."' AND orders.orderstatus='Odebrana'");

    $pizzaPriceSum = 0;

    echo '<div class="finished-orders">';
    echo '<h2>HISTORIA ZAMÓWIEŃ</h2>';
    echo '<table>';
    echo '
        <tr>
            <th>PIZZA</th>
            <th>CENA</th>
        </tr>
    ';
    while($row = $result->fetch_array())
    {
        $pizzaPriceSum += $row['price'];
        echo '    
            <tr>
                <td>'.$row['pizzaname'].'</td>
                <td>'.$row['price'].'zł</td>
            </tr>
        ';
    }
    echo '
        <tr class="history-price-sum">
            <td>Ile u nas wydałeś</td>
            <td>'.$pizzaPriceSum.'zł</td>
        </tr>
    ';

    echo '</div>';
?>
