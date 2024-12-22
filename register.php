<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="registerstyles.css"/>
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
<div class="register-container">
    <h2>Login</h2>
    <form action="handler.php" method="POST">
        <div class="div_text">
            <p>Du hast einen Accout? klick <a href="login.php">hier</a></p>
        </div> 
        <input type="hidden" name="method" value="register">
        <input name="errorMsg" id="errorMsg" type=<?php echo $loginFailed?'text':'hidden'?> readonly value ="<?php echo htmlspecialchars($errorMsg)?>">
        <label for="username">Benutzername</label>
        <input type="text" id="username" name="username" required>
        <label for="E-Mail">E-Mail</label>
        <input type="E-Mail" id="email" name="mail" required>
        <label for="password">Passwort</label>
        <input type="password" id="password" name="password" required>
        <div class="checkbox-container">
            <input type="checkbox" id?="show-password" onclick="togglePassword()">Passwort anzeigen </input>
        </div> 
        <button type="submit" value="register" >Registrieren</button>
    </form>
</div>
</body>
</html>