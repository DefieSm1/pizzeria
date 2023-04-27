<?php
    if($_COOKIE['userRole'] != "admin")
    {
        header('Location: main_page.php');
        exit;
    }

    require_once("db_stuff.php");

    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);

    $result = $conn->query("SELECT * FROM pizzas WHERE pizzadisabled=FALSE");

    echo '<div>';
    echo '<h1>Pizze</h1>';
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
                    <form action="delete_pizza.php" method="post">
                        <button type="submit" name="pizzaId" value="'.$row['id'].'">Usuń</button>
                    </form>
                </td>
            </tr>
        ';
    }
    echo '</table>';
    echo '</div>';

    echo '<div>';

?>
    <h1>Dodaj Pizzę</h1>
    <form class="postForm" action="add_pizza.php" method="post">
        <div class="form-inputs">
            <input type="text" name="pizzaName" placeholder="Nazwa"><br>
            <input type="text" name="pizzaDescription" placeholder="Składniki"><br>
            <input type="number" name="pizzaPrice" placeholder="Cena (zł)"><br>
        </div>  
        <button type="submit" class="button" style="font-size: 18px;">Dodaj!</button>
    </form>

<?php

    echo '</div>';

    echo '<div>';

    $result = $conn->query("SELECT * FROM pizzas WHERE pizzadisabled=TRUE");

    echo '<div>';
    echo '<h1>Usunięte Pizze</h1>';
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
                    <form action="readd_pizza.php" method="post">
                        <button type="submit" name="pizzaId" value="'.$row['id'].'">Przywróć</button>
                    </form>
                </td>
            </tr>
        ';
    }
    echo '</table>';
    echo '</div>';

    echo '<div>';

    echo '</div>';

    $conn->close();
?>