<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="registerstyles.css"/>
    <script src="loginfunctions.js"></script>
    <?php
    include("sqlite.php");
    ?>
</head>
<body>

    <div class="register-container">
        <h2>Login</h2>
        <form action="sqlite.php" method="POST">
            <div class="div_text">
                <p>Du hast einen Accout? klick <a href="login.php">hier</a></p>
            </div> 
            <label for="username">Benutzername</label>
            <input type="text" id="username" name="username" required>
            <label for="E-Mail">E-Mail</label>
            <input type="E-Mail" id="email" name="email" required>
            <label for="password">Passwort</label>
            <input type="password" id="password" name="password" required>
        <div class="checkbox-container">
            <input type="checkbox" id?="show-password" onclick="togglePassword()">Passwort anzeigen </input>
        </div> 
            <button type="submit" value="CreateUser" onclick="login()">Registrieren</button>
    </div>
</form>

</body>
</html>