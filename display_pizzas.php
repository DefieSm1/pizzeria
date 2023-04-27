<?php
    require_once("db_stuff.php");

    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);

    $result = $conn->query("SELECT * FROM pizzas WHERE pizzadisabled=FALSE");

    echo '<table class="pickpizza">';
    echo '
        <tr>
            <th>NAZWA</th>
            <th>ELEMENTY</th>
            <th>CENA</th>
        </tr>
    ';
    while($row = $result->fetch_array())
    {
        echo '    
            <tr>
                <td>'.$row['pizzaname'].'</td>
                <td>'.$row['pizzadescription'].'</td>
                <td>'.$row['price'].'zł</td>
                <td>
                    <form action="add_order.php" method="post">
                        <button type="submit" name="pizza" value='.$row['id'].'>Zakup</button>
                    </form>
                </td>
            </tr>
        ';
    }
    echo '</table>';
?>
