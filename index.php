<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="Formstyles.css" />
    <link rel="stylesheet" href="sidbarstyles.css" />
    <link rel="stylesheet" href="sidebarform.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="function.js"></script>
    <script src="drag and drop.js"></script>

</head>

<body>
    <!------------------------------------------------------ CREATETODO FORM ------------------------------------------------------>
    <?php
    include("sqlconn.php");
    $sqlconn = SQLConn::getInstance();
    //$sqlconn->login('testuser','StrongPassword');
    // echo $_SESSION['uid'];
    ?>
    <div class="Form_Popup" id="myForm">
        <form class="Form_Container" action="handler.php" method="POST">
            <input type="hidden" name="method" value="CreateTodo">
            <input type="hidden" name="priority" id="priority" value="">
            <div class="Form_Header">
                <h1>Neuer To Do</h1>
                <button type="button" class="CloseForm" onclick="closeFrom()"><i class="fa fa-times-circle-o"
                        aria-hidden="true"></i></button>
            </div>
            <div class="div_text_date">
                <input type="text" name="name" placeholder="Neuer Eintrag" required id="text_input">
                <input type="date" name="enddate" id="date_input">
            </div>
            <!-- <div class="div_time">
                <p>Von</p>
                <input type="time" placeholder="Von">
                <p>Bis</p>
                <input type="time" placeholder="Bis">
            </div> -->
            <div class="div_Form_Textarea">
                <textarea class="Form_Textarea" type="text" name="description" placeholder="Beschreibung"
                    id="big_text_input"></textarea>
            </div>
            <div class="Form_Bottom">
                <button type="submit" value="createTodo" class="AddEntry">hinzufügen</button>
            </div>
        </form>
    </div>
    <!-- onclick="createToDo()" -->
    <!------------------------------------------------------ CREATE DELETEFORM ------------------------------------------------------>
    <div id="DeleteForm" class="SidebarForm_Container">
        <form id="SFORM" class="SidebarForm" action="handler.php" method="POST">
            <input type="hidden" name="method" value="DeleteProject">
            <input type="hidden" name="pname" id="pname" value="">
            <div class="SF_Text">
                <p>Möchten sie das Projekt wirklich löschen</p>
            </div>
            <div class="SF_buttons">
                <button type="button" class="SF_button" onclick="closeSidebarForm()">abbrechen</button>
                <button type="submit" class="SF_button">löschen</button>
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
                    <button class="headerbtn" id="Team"><i class="fa fa-users" aria-hidden="true"></i>
                        <p>Teams</p>
                    </button>
                    <div class="dropdown-content">
                        <a href="#">Team1</a>
                        <a href="#">Team2</a>
                    </div>
                </div>
                <div class="headerbuttons_right">
                    <button class="headerbtn" id="User"><i class="fa fa-user-circle-o" aria-hidden="true"></i></button>
                    <form action="handler.php" method="POST" class="headerform">
                        <?php
                        if (isset($_SESSION['uid']) && $_SESSION != false) {
                            $action = 'logout';
                            $classname = 'fa-sign-out';
                        } else {
                            $action = 'gotologin';
                            $classname = 'fa-sign-in';
                        }

                        ?>
                        <input type="hidden" name="method" value="<?php echo $action; ?>">
                        <button type="submit" class="headerbtn"><i class="fa <?php echo $classname ?>"
                                aria-hidden="true"></i></button>
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
                <!-- <div id="sidebarelements"> -->
                <?php
                $projects = $sqlconn->getProjects();
                foreach ($projects as $project):
                    ?>
                    <Form name="SidebarProject" action="handler.php" method="POST">
                        <input type="hidden" name="method" value="ChangeProject">
                        <div class="SidebarElements">
                            <input type="hidden" name="projectId" value="<?php echo htmlspecialchars($project['id']) ?>">
                            <button class="sidebarbutton" type="submit">
                                <p><?php echo htmlspecialchars($project['name']) ?></p>
                            </button>
                            <button class="sidebarbutton" id="OpenSidebarForm"
                                onclick="OpenForm('<?php echo htmlspecialchars($project['name']) ?>')" type="button"><i
                                    class="fa fa-close" aria-hidden="true"></i></button>
                        </div>

                    </Form>
                <?php endforeach; ?>
                <div class="footer">
                    <button class="FooterButton" onclick="open_form_sidebar()">Neues Projekt</button>
                </div>
                <form id="footer_form" action="handler.php" method="POST">
                    <div class="footer_clicked">
                        <div class="footer_clicked_input">
                            <input type="hidden" name="method" value="newProject">
                            <input type="text" placeholder="Neues Projekt" id="footer_input" name="projectname">
                        </div>
                        <div class="footer_clicked_buttons">
                            <button type="button" class="footer_clicked_button"
                                onclick="footer_close()">abbrechen</button>
                            <button type="submit" class="footer_clicked_button" id="cancel_button"
                                onclick="add_project()">erstellen</button>
                        </div>

                    </div>
                </form>
                <!-- </div> -->

            </div>
            <!------------------------------------------------------ Main ------------------------------------------------------>
            <div class="main">
                <?php $projectsName = $sqlconn->getcurrentProject(); ?>
                <h2>
                <?php echo htmlspecialchars($projectsName['name']) ?>
                </h2>
                <div class="PriorityCategories">
                    <div class="PriorityElement">
                        <div class="PriorityHeader" id="HeaderHigh">
                            <h3>High</h3>
                            <button class="NewEntry" onclick="OpenPopup('High')"><i class="fa fa-plus"
                                    aria-hidden="true"></i> New Entry</button>

                        </div>
                        <?php
                        $items = $sqlconn->getTodos('High');
                        ?>
                        <div class="PriorityArea" id="High" ondrop="drop(event)" ondragover="allowDrop(event)">
                            <?php foreach ($items as $item): ?>
                                <div class="item" id="item-<?php echo $item['id']; ?>" data-id="<?php echo $item['id']; ?>"
                                    draggable="true" ondragstart="drag(event)">

                                    <div class="ToDoTitle">
                                    <span><?php echo htmlspecialchars($item['name']); ?></span>

                                    <form class="updatePosition" action="handler.php" method="POST">
                                        <input type="hidden" name="method" value="updatePosition">
                                        <input type="hidden" name="priority" value="High">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <input type="hidden" name="position" value="<?php echo $item['position']; ?>">
                                    </form>
                                    <div>
                                        <input type="hidden" name="method" value="showToDo">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" data-target="itemdata-<?php echo $item['id']; ?>" class="show_button" onclick="show_data()">
                                        <i class="fa fa-eye"></i>
                                        </button>
                                    <form action="handler.php" method="POST" style="display: inline;" >
                                        <input type="hidden" name="method" value="deleteTodo">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" class="delete_button">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        </div>
                                    </form>
                                    </div>
                                    <div class="ToDoData" id="itemdata-<?php echo $item['id']; ?>">
                                        <p type="date" class="ToDoEnddatae" style="display: flex;">Endtermin: <?php echo date("d.m.Y", strtotime($item['enddate']));?></p>
                                        <p type="text" class="ToDoDescription" style="display: flex;"><?php echo $item['description'];?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="PriorityElement">
                        <div class="PriorityHeader" id="HeaderMedium">
                            <h3>Medium</h3>
                            <button class="NewEntry" onclick="OpenPopup('Medium')"><i class="fa fa-plus"
                                    aria-hidden="true"></i> New
                                Entry</button>
                        </div>
                        <?php
                        $items = $sqlconn->getTodos('Medium');
                        ?>
                        <div class="PriorityArea" id="Medium" ondrop="drop(event)" ondragover="allowDrop(event)">
                            <?php foreach ($items as $item): ?>
                                <div class="item" id="item-<?php echo $item['id']; ?>" data-id="<?php echo $item['id']; ?>"
                                    draggable="true" ondragstart="drag(event)">
                                    <span><?php echo htmlspecialchars($item['name']); ?></span>
                                    <form class="updatePosition" action="handler.php" method="POST">
                                        <input type="hidden" name="method" value="updatePosition">
                                        <input type="hidden" name="priority" value="Medium">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <input type="hidden" name="position" value="<?php echo $item['position']; ?>">
                                    </form>
                                    <div style="display: flex;" >
                                    <form action="handler.php" method="POST" style="display:inline; margin-right: 5%;">
                                        <input type="hidden" name="method" value="showToDo">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" class="show_button">
                                        <i class="fa fa-pencil"></i>
                                        </button>
                                    </form>
                                    <form action="handler.php" method="POST" style="display: inline;" >
                                        <input type="hidden" name="method" value="deleteTodo">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" class="delete_button">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>


                    <div class="PriorityElement">
                        <div class="PriorityHeader" id="HeaderLow">
                            <h3>Low</h3>
                            <button class="NewEntry" onclick="OpenPopup('Low')"><i class="fa fa-plus"
                                    aria-hidden="true"></i> New
                                Entry</button>
                        </div>
                        <?php
                        $items = $sqlconn->getTodos('Low');
                        ?>
                        <div class="PriorityArea" id="Low" ondrop="drop(event)" ondragover="allowDrop(event)">
                            <?php foreach ($items as $item): ?>
                                <div class="item" id="item-<?php echo $item['id']; ?>" data-id="<?php echo $item['id']; ?>"
                                    draggable="true" ondragstart="drag(event)">
                                    <span><?php echo htmlspecialchars($item['name']); ?></span>
                                    <form class="updatePosition" action="handler.php" method="POST">
                                        <input type="hidden" name="method" value="updatePosition">
                                        <input type="hidden" name="priority" value="Low">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <input type="hidden" name="position" value="<?php echo $item['position']; ?>">
                                    </form>
                                    <div style="display: flex;" >
                                    <form action="handler.php" method="POST" style="display:inline; margin-right: 5%;">
                                        <input type="hidden" name="method" value="showToDo">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" class="show_button">
                                        <i class="fa fa-pencil"></i>
                                        </button>
                                    </form>
                                    <form action="handler.php" method="POST" style="display: inline;" >
                                        <input type="hidden" name="method" value="deleteTodo">
                                        <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
                                        <button type="submit" class="delete_button">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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