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
        include("sqlconn.php");
        $sqlconn = new SQLConn();
        //$sqlconn->login('testuser','StrongPassword');
        // echo $_SESSION['uid'];
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
            <div class="left_header_container">
                <div class="dropdown">
                    <button class="headerbtn" id="Team"><i class="fa fa-users" aria-hidden="true"></i><p>Teams</p></button>
                    <div class="dropdown-content">
                    <a href="#">Team1</a>
                    <a href="#">Team2</a>
                    </div>     
                </div>
                <div class="headerbuttons_right">
                    <button class="headerbtn" id="User"><i class="fa fa-user-circle-o" aria-hidden="true"></i></button>
                    <form action="handler.php" method="POST">
                        <?php 
                            if(isset($_SESSION['uid']) && $_SESSION != false) {
                                $action = 'logout';
                                $classname = 'fa-sign-out';
                            } else {
                                $action = 'gotologin';
                                $classname = 'fa-sign-in';
                            }
                        
                        ?>    
                        <input type="hidden" name="method" value="<?php echo $action; ?>">
                        <button type="submit" class="headerbtn"><i class="fa <?php echo $classname ?>" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </header>
<!------------------------------------------------------ ContentWrapper ------------------------------------------------------>
        <div class="ContentWrapper">
<!------------------------------------------------------ Sidebar ------------------------------------------------------>
            <div class="sidebar" id="test1">
                <div class="resizer" id=test2></div>
                    <button class="openbtn" onclick="changeNav()">&#9776;</button>
                    <div id="sidebarelements">
                        <div class="footer"><button class="FooterButton"onclick="open_form_sidebar()">Neues Projekt</button></div>
                        <form id="footer_form" action="handler.php" method="POST">
                        <div class="footer_clicked">
                            <div class="footer_clicked_input">
                            <input type="hidden" name="method" value="newProject">
                                <input type="text" placeholder="Neues Projekt" id="footer_input"name="projectname">
                            </div>
                            <div class="footer_clicked_buttons">
                                <button type="button"class="footer_clicked_button" onclick="footer_close()">abbrechen</button>
                                <button type="submit"class="footer_clicked_button" id="cancel_button"onclick="add_project()">erstellen</button>
                            </div>

                        </div>
                        </form>
                    </div>

            </div>
<!------------------------------------------------------ Main ------------------------------------------------------>
            <div class="main">
                <h2>ProjectName</h2>
                <div class="PriorityCategories">
                    <div class="PriorityElement">
                        <div class="PriorityHeader"id="HeaderHigh">
                            <h3>High</h3>
                            <button class="NewEntry" onclick="OpenPopup('High')"><i class="fa fa-plus" aria-hidden="true"></i>  New Entry</button>
                        </div>
                        <div class="PriorityArea" id="High" ondrop="drop(event)" ondragover="allowDrop(event)">
                        </div>
                    </div>

                    <div class="PriorityElement">
                        <div class="PriorityHeader"id="HeaderMedium">
                            <h3>Medium</h3>
                            <button class="NewEntry" onclick="OpenPopup('Medium')"><i class="fa fa-plus" aria-hidden="true"></i>  New Entry</button>
                        </div>
                        <div class="PriorityArea" id="Medium" ondrop="drop(event)" ondragover="allowDrop(event)">

                        </div>
                    </div>


                    <div class="PriorityElement">
                        <div class="PriorityHeader"id="HeaderLow">
                            <h3>Low</h3>
                            <button class="NewEntry" onclick="OpenPopup('Low')"><i class="fa fa-plus" aria-hidden="true"></i>  New Entry</button>
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