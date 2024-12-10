<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="Formstyles.css" />
    <link rel="stylesheet" href="sidbarstyles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="function.js"></script>
    <script src="drag and drop.js"></script>

</head>
<body>
    <!------------------------------------------------------ ANFANG CREATETODO FORM ------------------------------------------------------>
    <?php
        // include("sql.php");
        // getUser("Test","Test2");
    ?>
    <div class="Form_Popup" id="myForm">
        <form class="Form_Container">
            <div class="Form_Header">
                <h1>Neuer To Do</h1>
                <button type="button"class="CloseForm" onclick="closeFrom()">X</button>
            </div>
            <div class="div_text_date">
                <input type="text" placeholder="Neuer Eintrag" required="required" id="text_input">
                <input type="date" id="date_input">
            </div>
            <!-- <div class="div_time">
                <p>Von</p>
                <input type="time" placeholder="Von">
                <p>Bis</p>
                <input type="time" placeholder="Bis">
            </div> -->
            <div class="div_Form_Textarea">
                <textarea class="Form_Textarea" placeholder="Beschreibung" id="big_text_input"></textarea>
            </div>
            <div class="Form_Bottom">
                <button type="button" class="AddEntry" onclick="createToDo()">hinzufügen</button>
            </div>
        </form>
    </div>
    <!------------------------------------------------------ ENDE CREATETODO FORM ------------------------------------------------------>

    <div class="ScreenWrapper" id="ScreenWrapperID">
<!------------------------------------------------------ Header ------------------------------------------------------>
        <header>
            <h1>To Do Liste</h1>
            <button class="headerbtn" id="User"><i class="fa fa-user-circle-o" aria-hidden="true"></i></button>
            <button class="headerbtn" id="log_out"><i class="fa fa-sign-out" aria-hidden="true" onclick="Logout()"></i></button>
        </header>
<!------------------------------------------------------ Sidebar ------------------------------------------------------>
        <div class="ContentWrapper">
            <div class="sidebar">
                <button class="openbtn" onclick="changeNav()">&#9776;</button>
                <div id="sidebarelements">
                    <a href="#">About</a>
                    <!-- <a href="sortable.html">Sortable</a> -->
                    <a href="#">Test</a>
                    <a href="Impressum.php">Impressum</a>
                </div>
            </div>
<!------------------------------------------------------ Main ------------------------------------------------------>
            <div class="main">
                <h2>ProjectName</h2>
                <div class="PriorityCategories">

                    <div class="PriorityElement" id="High" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <h3>High</h3>
                        <button class="NewEntry" value="High" onclick="OpenPopup('High')">New Entry</button>
                        <!-- <button class="addElement"></button> -->
                        <div id="item1" class="item" draggable="true" ondragstart="drag(event)"><p>test1</p><button class="itemButton">...</button> </div>
                        <div id="item2" class="item" draggable="true" ondragstart="drag(event)">test 2<button class="itemButton" type="button"></button></div>
                        <div id="item3" class="item" draggable="true" ondragstart="drag(event)">test 3</div>
                        <div id="item4" class="item" draggable="true" ondragstart="drag(event)">test 4</div>
                    </div>


                    <div class="PriorityElement" id="Medium" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <h3>Medium</h3>
                        <button class="NewEntry" value="Medium" onclick="OpenPopup('Medium')">New Entry</button>
                        <!-- <button class="addElement"></button> -->
                    </div>


                    <div class="PriorityElement" id="Low" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <h3>Low</h3>
                        <button class="NewEntry" value="Low" onclick="OpenPopup('Low')">New Entry</button>
                        <!-- <button class="addElement"></button> -->
                    </div>
                </div>
            </div>
<!------------------------------------------------------ Ende Main ------------------------------------------------------>      
        </div>
    </div>
</body>

</html>