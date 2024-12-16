<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="loginstyles.css"/>
    <script src="loginfunctions.js"></script>
    <?php
    include("sqlite.php");
    ?>

</head>
<body>

    <div class="login-container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="div_text">
                <p>Noch keinen Accout klick <a href="register.php">hier</a></p>
            </div> 
            <label for="username">Benutzername</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Passwort</label>
            <input type="password" id="password" name="password" required>
        <div class="checkbox-container">
            <input type="checkbox" id?="show-password" onclick="togglePassword()">Passwort anzeigen </input>
        </div> 
            <button type="submit" value="Einloggen" onclick="login()">Einloggen</button>
    </div>
</form>

</body>
</html>
