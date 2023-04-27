<h1>Logowanie</h1>
<form class="postForm" action="login.php" method="post">
    <div class="form-inputs">
        <input type="text" name="username" placeholder="Nazwa użytkownika" required><br>
        <input type="password" name="password" placeholder="Hasło" required><br>
    </div>  
    <button type="submit" class="button" name="isSubmitted" value="true">Zaloguj się!</button>
</form>
<form class="postForm" action="?" method="get">
    <button type="submit" name="indexPage"  value="register">Zarejestruj się</button>
</form>