<h1>Rejestracja</h1>
<form class="postForm" action="register.php" method="post">
    <div class="form-inputs">
        <input type="text" name="username" placeholder="Nazwa użytkownika" required><br>
        <input type="password" name="password" placeholder="Hasło" required><br>
        <input type="password" name="confirmPassword" placeholder="Powtórz hasło" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
    </div>  
    <button type="submit" class="button" name="isSubmitted" value="true">Zarejestruj się!</button>
</form>
<form class="postForm" action="?" method="get">
    <button type="submit" name="indexPage" value="login">Zaloguj się</button>
</form>