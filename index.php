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
    <!------------------------------------------------------ CREATETODO FORM ------------------------------------------------------>
    <?php
        // include("sql.php");
        // getUser("Test","Test2");
    ?>
    <div class="Form_Popup" id="myForm">
        <form class="Form_Container">
            <div class="Form_Header">
                <h1>Neuer To Do</h1>
                <button type="button"class="CloseForm" onclick="closeFrom()"><i class="fa fa-times-circle-o" aria-hidden="true"></i></button>
            </div>
            <div class="div_text_date">
                <input type="text" placeholder="Neuer Eintrag" required id="text_input">
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
 <!------------------------------------------------------ ScreenWrapper ------------------------------------------------------>
    <div class="ScreenWrapper" id="ScreenWrapperID">
<!------------------------------------------------------ Header ------------------------------------------------------>
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
<!------------------------------------------------------ ContentWrapper ------------------------------------------------------>
        <div class="ContentWrapper">
<!------------------------------------------------------ Sidebar ------------------------------------------------------>
            <div class="sidebar">
                <button class="openbtn" onclick="changeNav()">&#9776;</button>
                <div id="sidebarelements">
                    <a href="#">About</a>
                    <!-- <a href="sortable.html">Sortable</a> -->
                    <a href="#">Test</a>
                    <a href="Impressum.php">Impressum</a>

                    <div class="footer"><button class="FooterButton">Neue To Do</button></div>
                </div>
            </div>
<!------------------------------------------------------ Main ------------------------------------------------------>
            <div class="main">
                <h2>ProjectName</h2>
                <div class="PriorityCategories">

                    <div class="PriorityElement">
                        <div class="PriorityHeader">
                        <h3>High</h3>
                        <button class="NewEntry" value="High" onclick="OpenPopup('High')"><i class="fa fa-plus" aria-hidden="true"></i>  New Entry</button>
                        </div>
                        <div class="PriorityArea" id="High" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <!-- <div id="item1" class="item" draggable="true" ondragstart="drag(event)"><p>test1</p><button class="EditItem"><i class="fa fa-eye" aria-hidden="true"></i></button> </div>
                        <div id="item2" class="item" draggable="true" ondragstart="drag(event)">test 2<button class="EditItem" type="button"></button></div>
                        <div id="item3" class="item" draggable="true" ondragstart="drag(event)">test 3</div>
                        <div id="item4" class="item" draggable="true" ondragstart="drag(event)">test 4</div> -->
                        </div>
                    </div>


                    <div class="PriorityElement">
                    <div class="PriorityHeader">
                        <h3>Medium</h3>
                        <button class="NewEntry" value="Medium" onclick="OpenPopup('Medium')"><i class="fa fa-plus" aria-hidden="true"></i>  New Entry</button>
                    </div>
                    <div class="PriorityArea" id="Medium" ondrop="drop(event)" ondragover="allowDrop(event)">

                    </div>
                        <!-- <button class="addElement"></button> -->
                    </div>


                    <div class="PriorityElement">
                    <div class="PriorityHeader">
                        <h3>Low</h3>
                        <button class="NewEntry" value="Low" onclick="OpenPopup('Low')"><i class="fa fa-plus" aria-hidden="true"></i>  New Entry</button>
                        </div>
                        <div class="PriorityArea"  id="Low" ondrop="drop(event)" ondragover="allowDrop(event)">

                        </div>
                    </div>
                </div>
            </div>
<!------------------------------------------------------ Ende Main ------------------------------------------------------>      
        </div>
<!------------------------------------------------------ Ende Contentwrapper ------------------------------------------------------>  
    </div>
<!------------------------------------------------------ Ende Screenwrapper ------------------------------------------------------>  
</body>

</html>