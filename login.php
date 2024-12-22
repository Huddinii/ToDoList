<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="loginstyles.css"/>
    <script src="loginfunctions.js"></script>
    <?php
    include("sqlconn.php");
    ?>

</head>
<body>
<?php
    $loginFailed = isset($_GET['loginFailed']) && $_GET['loginFailed'] ;
    $errorMsg = isset($_GET['errorMsg']) ? urldecode($_GET['errorMsg']): '';
?>
<div class="login-container">
    <h2>Login</h2>
    <form action="handler.php" method="POST">
        <div class="div_text">
            <p>Noch keinen Accout klick <a href="register.php">hier</a></p>
        </div> 
        <input type="hidden" name="method" value="login">
        <input name="errorMsg" id="errorMsg" type=<?php echo $loginFailed?'text':'hidden'?> readonly value ="<?php echo htmlspecialchars($errorMsg)?>">
        <label for="username">Benutzername</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Passwort</label>
        <input type="password" id="password" name="password" required>
        <div class="checkbox-container">
            <input type="checkbox" id?="show-password" onclick="togglePassword()">Passwort anzeigen </input>
        </div> 
        <button type="submit" value="Einloggen">Einloggen</button>
    </form>
</div>

</body>
</html>
