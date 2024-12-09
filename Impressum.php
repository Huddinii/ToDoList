<!DOCTYPE html>
<html>
<body>
    <head>
        <link rel="stylesheet" href="Impressumstyles.css"/>
        <link rel="stylesheet" href="sidbarstyles.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="function.js"></script>
    </head>
</body>
<div class="ScreenWrapper">
    <div class="header">
        <header>
            <h1>To Do Liste</h1>
            <button class="headerbtn" id="User"><i class="fa fa-user-circle-o" aria-hidden="true"></i></button>
            <button class="headerbtn" id="log_out"><i class="fa fa-sign-out" aria-hidden="true" onclick="Logout()"></i></button>
        </header>
    </div>
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
            <h3>test</h3>
        </div>
    </div>
</div>

</html>