<!DOCTYPE html>
<html>
<body>
    <head>
        <link rel="stylesheet" href="styles.css"/>
        <link rel="stylesheet" href="sidbarstyles.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="function.js"></script>
    </head>
</body>
<div class="ScreenWrapper">
<header>
            <div class="headerbutton_left">
                <button class="headerbtn" id="About_Us" onclick="Impressum()">About us</button>
            </div> 
            <h1>To Do Liste</h1>
            <div class="headerbuttons_right">
                <button class="headerbtn" id="User"><i class="fa fa-user-circle-o" aria-hidden="true"></i></button>
                <button class="headerbtn" id="log_out"><i class="fa fa-sign-out" aria-hidden="true" onclick="Logout()"></i></button>
            </div>
        </header>
    <div class="ContentWrapper">
        <div class="sidebar">
            <button class="openbtn" onclick="changeNav()">&#9776;</button>
            <div id="sidebarelements">
                <!--<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>-->
                <a href="index.php">About</a>
                <a href="#">Services</a>
                <a href="#">Clients</a>
                <a href="#">Impressum</a>
            </div>
        </div>
        <div class="main">
            <h2>Über uns</h2>
            <p>Dies ist unser To Do Listen Projekt für BTS.</p>
            <h2>Impressum</h2>
            <h3>Kontakt</h3>
            <p>
                To Do Liste UG <br>
                Odenwaldstraße 5 <br>
                74172 Neckarsulm
            </p>
            <p>
                <strong>Telefon:</strong> (07132) 65 37 37 <br>
                <strong>Telefax:</strong> (07132) 65 37 42 
            </p>
            <p>
                <strong>E-Mail:</strong> info@todoliste.de
            </p>
            
        </div>
    </div>
</div>

</html>