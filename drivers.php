<?php 
    if($_COOKIE['userRole'] != "admin")
    {
        header('Location: main_page.php');
    }
?>
<h1>Dodaj dostawcę</h1>
<form class="postForm" action="add_driver.php" method="post">
    <div class="form-inputs">
        <input type="text" name="username" placeholder="Nazwa użytkownika" required><br>
        <input type="password" name="password" placeholder="Hasło" required><br>
        <input type="password" name="confirmPassword" placeholder="Powtórz hasło" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
    </div>  
    <button type="submit" class="button" name="isSubmitted" value="true">Dodaj dostawcę!</button required>
</form>