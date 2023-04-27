<?php 
    session_start();

    $title = "Login";

    require('header.php');
?>

<html>
    <div class="loginContainer">
        <img class="pizzaLogo" src="pizza.png" alt="Pizza">
        <?php 
            if(isset($_COOKIE['userLoggedIn'])) {
                header('Location: main_page.php');
                exit();
            }

            if(!isset($_GET['indexPage']) || $_GET['indexPage'] == "login") 
            { 
                require_once('login-form.php');
            } 
            else 
            { 
                require_once('register-form.php');
            } 

            if(isset($_GET['msg'])) 
            {
                echo $messageCodes[$_GET['msg']];
            }
        ?>
    </div>
</html>