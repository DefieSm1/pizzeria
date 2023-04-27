<?php 
    session_start();

    $title = "Dane użytkownika";

    require_once('header.php');

    if(!isset($_COOKIE['userLoggedIn']))
        header("Location: index.php");
?>

<html>
    <header>
        <div class="header-left">

        </div>
        <div class="header-right">
            <a href="main_page.php">
                <button>Wróć</button>
            </a>
            <a href="logout.php">
                <button>Wyloguj się</button>
            </a>
        </div>
    </header>
    <div class="user-info">
        <h1>Zmień dane</h1>
        <p>Puste pole oznacza brak zmiany</p>
        <form action="edit_data.php" method="post">
            <label for="username">Nazwa użytkownika</label>
            <input type="text" name="newUsername" id="" placeholder="">

            <label for="email">Email</label>
            <input type="email" name="newEmail" id="">

            <label for="userRole">Permisje</label>
            <input type="text" name="userRole" id="" value="<?php echo $_COOKIE['userRole']?>" disabled>

            <label for="newPassword">Nowe hasło</label>
            <input type="password" name="newPassword" id="">

            <label for="newPasswordConfirm">Potwierdź nowe hasło</label>
            <input type="password" name="newPasswordConfirm" id="">

            <label for="oldPassword">Stare hasło</label>
            <input type="password" name="oldPassword" id="">

            <button type="submit">Zmień dane!</button>
        </form>
        <?php 
            if(isset($_GET['msg'])) 
            {
                echo $messageCodes[$_GET['msg']];
            }
        ?>
    </div>
</html>