<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css"/>
    <link rel="stylesheet" href="Formstyles.css"/>
    <link rel="stylesheet" href="sidbarstyles.css"/>
    <script src="function.js"></script>
</head>
<body>
        <div class="Form_Popup" id="myForm">
                    <form class="Form_Container">
                    <div class="Form_Header">
                    <h1>Neuer To Do</h1>
                    <button class="CloseForm" onclick="closeFrom()">X</button>
                    </div>
                    <div class="div_text_date">
                    <input type="text" placeholder="Neuer Eintrag" required="required" id="text_input">
                    <input type="date">
                    </div>
                    <div class="div_time">
                    <p>Von</p>
                    <input type="time" placeholder="Von">
                    <p>Bis</p>
                    <input type="time" placeholder="Bis">
                    </div>
                    <div class="div_Form_Textarea">
                    <textarea class="Form_Textarea" placeholder="Beschreibung"></textarea>
                    </div>
                    <div class="Form_Bottom">
                    <button class="AddEntry" onclick="createToDo()">hinzufügen</button>
                    </div>
                    </form>
        </div>


    <div class="ScreenWrapper" id="ScreenWrapperID">
        <!-- <div class="header"> -->
            <header>
                <h1>To Do Liste</h1>
                <button class="headerbtn">&#9978;</button>
            </header>
        <!-- </div> -->
        <div class="ContentWrapper">
            <div class="sidebar">
                <button class="openbtn" onclick="changeNav()">&#9776;</button>
                <div id="sidebarelements">
                    <a href="main.html">About</a>
                    <a href="#">Services</a>
                    <a href="#">Clients</a>
                    <a href="Impressum.html">Impressum</a>
                </div>
            </div>

            <div class="main">
                <h2>ProjectName</h2>
                <button class="NewEntry" onclick="OpenPopup()">New Entry</button>

                <div class="PriorityCategories">
                    <div class="PriorityElement" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <h3>Highest</h3>
                        <!-- <button class="addElement"></button> -->
                        <div id="item1" class="item" draggable="true" ondragstart="drag(event)">
                            <p>test1</p>
                            <button class="EditItem">...</button>
                        </div>
                        <div id="item2" class="item" draggable="true" ondragstart="drag(event)">test 2</div>
                        <div id="item3" class="item" draggable="true" ondragstart="drag(event)">test 3</div>
                        <div id="item4" class="item" draggable="true" ondragstart="drag(event)">test 4</div>
                    </div>
                    <div class="PriorityElement" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <h3>High</h3>
                        <!-- <button class="addElement"></button> -->
                    </div>
                    <div class="PriorityElement" id="Medium" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <h3>Medium</h3>
                        <!-- <button class="addElement"></button> -->
                    </div>
                    <div class="PriorityElement" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <h3>Low</h3>
                        <!-- <button class="addElement"></button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>