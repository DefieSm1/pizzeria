<?php 
    if($_COOKIE['userRole'] == "user")
    {
        header('Location: main_page.php');
        exit;
    }
    
    require_once("db_stuff.php");

    $conn = new mysqli($serverName, $dbUsername, $dbPassword, $dbName);

    echo '<h1>Wybierz użytkownika</h1>';
    echo '
    <form action="?subpage=ordermanage" method="post" class="user-select">
        <select name="userId" id="">
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
        <button type="submit" name="subpage" value="ordermanage">Wybierz</button>
    </form>
    ';

    if(isset($_POST['userId']) || isset($_SESSION['lastUserManaged'])) 
    {
        $userId = $_POST['userId'] ?? $_SESSION['lastUserManaged'];
        $_SESSION['lastUserManaged'] = $userId;
        
        if($conn->query('SELECT * FROM users WHERE id='.$userId)->num_rows < 1)
        {
            echo '😵';
            exit;
        }
        
        $result = $conn->query("SELECT orders.id, orders.orderstatus, orders.lastchange, pizzas.pizzaname, pizzas.price FROM orders JOIN pizzas 
                                ON orders.pizza=pizzas.id WHERE NOT orders.orderstatus='Odebrana'");

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
        while($row = $result->fetch_assoc())
        {
            echo '    
                <tr>
                    <td>'.$row['pizzaname'].'</td>';
            echo'<td>
                    <form action="change_status.php" method="post" class="order-status">
                        <select name="status" id="">
                            <option value="" disabled selected>'.$row['orderstatus'].'</option>';
            if($_COOKIE['userRole'] == 'admin')
                echo '<option value="Zakupiona">Zakupiona</option>
                      <option value="W przygotowaniu">W przygotowaniu</option>';
            
            echo '          <option value="Dostarczana">Dostarczana</option>
                            <option value="Odebrana">Odebrana</option>
                        </select>
                        <button type="submit" name="order" value="'.$row['id'].'" class="order-status-button">Zmień</button>
                    </form>
                </td>  
                    <td>'.$row['lastchange'].'</td>
                    <td>'.$row['price'].'zł</td>
                </tr>
            ';
        }

        echo '</table>';
        echo '</div>';
    }

    $conn->close();
    exit;
?>