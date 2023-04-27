<?php 
    session_start();

    $title = "Strona główna";

    require_once('header.php');

    
    if(!isset($_COOKIE['userLoggedIn']))
        header("Location: index.php");
    
    $userRole = $_COOKIE['userRole'] ?? 'user';
?>

<html>
    <header>
        <div class="header-left">
            <?php
            if($userRole == 'admin' && ($_GET['subpage'] ?? "") != 'delivery')
            {
                echo
                    '<a href="?subpage=delivery">
                        <button>Dodaj dostawcę</button>
                    </a>';
            }
            if($userRole == 'admin' && $userRole != 'driver' && ($_GET['subpage'] ?? "") != 'ordermanage')
            {
                echo 
                    '<a href="?subpage=ordermanage">
                        <button>Zamówienia</button>
                    </a>';
            }
            if($userRole == 'admin' && $userRole != 'driver' && ($_GET['subpage'] ?? "") != 'pizzamanage')
            {
                echo 
                    '<a href="?subpage=pizzamanage">
                        <button>Zarządzaj pizzami</button>
                    </a>';
            }
            if($userRole == 'user' && ($_GET['subpage'] ?? "") != 'buy')
            {
                echo
                    '<a href="?subpage=buy">
                        <button>Zakup coś nowego!</button>
                    </a>';
            }
            if($userRole == 'user' && ($_GET['subpage'] ?? "") != 'pizzastory')
            {
                echo
                    '<a href="?subpage=pizzastory">
                        <button>Historia zamówień</button>
                    </a>';
            }
            if(($_GET['subpage'] ?? "") != 'techsupport')
            {
                echo 
                    '<a href="?subpage=techsupport">
                        <button>Czat techniczny</button>
                    </a>';
            }
            ?>
        </div>
        <div class="header-right">
            <h3>Zalogowano jako: <?php echo $_COOKIE['userLoggedIn']; ?></h3>
            <a href="user_info.php">
                <button>Zmień dane</button>
            </a>

            <a href="logout.php">
                <button>Wyloguj się</button>
            </a>
        </div>
    </header>
    <div class="main-page">
        <?php
            switch(($_GET['subpage'] ?? ""))
            {
                case "buy":
                    require_once("display_pizzas.php");
                    break;
                case "pizzastory":
                    echo '<div class="pizza-history">';
                    require_once("pizzastory.php");
                    echo '</div>';
                    break;
                case "ordermanage":
                    echo '<div class="order-manage">';
                    require_once("manage_orders.php");
                    echo '</div>';
                    break;
                case "delivery":
                    require_once("drivers.php");
                    break;
                case "pizzamanage":
                    echo '<div class="pizza-manage">';
                    require_once("manage_pizzas.php");
                    echo '</div>';
                    break;
                case "techsupport":
                    echo '<div class="tech-support">';
                    require_once("tech_support.php");
                    echo '</div>';
                    break;
                default:
                    if($_COOKIE['userRole'] != "user")
                        require_once("manage_orders.php");
                    else
                        require_once("display_pizzas.php");
                    break;
            }
        ?>
    </div>
</html>