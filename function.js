/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */

function changeNav() {
  var sidebarElements = document.getElementById("sidebarelements")
  var sidebar = document.getElementById('test1')
  if (sidebarElements.style.display === "none"){
    setTimeout(() => {
    sidebar.style.width = '200px';
    sidebarElements.style.display = "block";
  }, 10);
  } else {
    setTimeout(() => {
    sidebar.style.width = '50px';  
    sidebarElements.style.display = "none";
  }, 10);
  }
}

window.addEventListener('beforeunload', (e) => {
  var xhr = new XMLHttpRequest();
  var data = 'method=logout'
  xhr.open('POST', 'handler.php', false);
    xhr.send(data);
});

document.addEventListener("DOMContentLoaded", () => {
const resizer = document.querySelector('.resizer');
const sidebar = document.querySelector('.sidebar');
let isResizing = false;
console.log("test");

resizer.addEventListener('mousedown', (e) => {
  isResizing = true;
  document.body.style.cursor = 'ew-resize'; // Cursor ändern
  console.log("angeklickt");
  e.preventDefault();
  const buttons = document.querySelectorAll(".ScreenWrapper button");
  buttons.forEach(button => {
    button.disabled = true; // Deaktiviert Buttons
  }); 
});

document.addEventListener('mousemove', (e) => {
  if (!isResizing) return;
  e.preventDefault();
  // Berechnung der neuen Breite
  const newWidth = e.clientX;
  if (newWidth > 185 && newWidth < 600) { // Mindest- und Maximalbreite
    sidebar.style.width = `${newWidth}px`;
    console.log("bewegt");
  }
});

document.addEventListener('mouseup', () => {
  isResizing = false;
  document.body.style.cursor = 'default'; // Cursor zurücksetzen
  const buttons = document.querySelectorAll(".ScreenWrapper button");
  buttons.forEach(button => {
    button.disabled = false; // Deaktiviert Buttons
  }); 
});
});




  let currentAbteilung = '';

  function OpenPopup(abteilung) {


    document.getElementById("myForm").style.display = "block";
    // document.getElementById("ScreenWrapperID").style.pointerEvents = "none";
    const ScreenWrapper = document.getElementsByClassName("ScreenWrapper")[0]
    ScreenWrapper.style.pointerEvents = "none";
    ScreenWrapper.style.backgroundColor = "rgba(0, 0, 0, 0.3)";
    const inputField = document.getElementById("text_input");
    const datetField = document.getElementById("date_input");
    const biginputField = document.getElementById("big_text_input");
    var priority = document.getElementById("priority");
    priority.value = abteilung;
    inputField.value = ''; // Eingabefeld leeren
    datetField.value = ''; // Eingabefeld leeren
    biginputField.value = ''; // Eingabefeld leeren
    currentAbteilung = abteilung;
    console.log(currentAbteilung);
    const buttons = document.querySelectorAll(".ScreenWrapper button");
    buttons.forEach(button => {
      button.disabled = true; // Deaktiviert Buttons
    }); 

  }

  function closeFrom() {
    document.getElementById("myForm").style.display = "none";
    const ScreenWrapper = document.getElementsByClassName("ScreenWrapper")[0]
    ScreenWrapper.style.pointerEvents = "";
    ScreenWrapper.style.backgroundColor = "rgba(0, 0, 0, 0)";
    const buttons = document.querySelectorAll(".ScreenWrapper button");
    buttons.forEach(button => {
      button.disabled = false; // Deaktiviert Buttons
    });
  }

  function createToDo() {
    var myInput = document.getElementById("text_input").value;
    
        // Neues Element erstellen
        var newItem = document.createElement("div");
        newItem.className = "item";
        newItem.draggable = true;
        newItem.ondragstart = drag;
        newItem.id = "item" + Date.now(); // Eindeutige ID vergeben
        newItem.textContent = myInput;
      
        // Button erstellen
        var newButton = document.createElement("button");
        newButton.className = "delete_button";
      
        // Font Awesome Icon hinzufügen
        var icon = document.createElement("i");
        icon.className = "fa fa-trash"; // Font Awesome Klassen für das Icon
        newButton.appendChild(icon);
      
        // Button Funktionalität definieren
        newButton.onclick = function() {
          newItem.remove(); // Entfernt das Div, wenn der Button geklickt wird
        };
        
        if(myInput === "" ){
          alert("Text Fehlt");
        }
        else{
          newItem.appendChild(newButton);
    
          // Füge das neue Element standardmäßig in die "Medium" Kategorie ein
          var Catergorie = document.getElementById("PriorityArea");
          // console.log(Catergorie);
          document.getElementById(currentAbteilung).appendChild(newItem);
          console.log(Catergorie);
        closeFrom();
        }
  }
  function open_form_sidebar()
  {
    var footer = document.querySelector('.footer');
    var footer_clicked = document.querySelector('.footer_clicked');
    footer.style.opacity = 0;
    footer.style.display = 'none';
    footer_clicked.style.opacity = 1;
    footer_clicked.style.display = 'block';
  }

  function footer_close()
  {
    var footer = document.querySelector('.footer');
    var footer_clicked = document.querySelector('.footer_clicked');
    footer.style.opacity = 1;
    footer.style.display = 'block';
    footer_clicked.style.opacity = 0;
    footer_clicked.style.display = 'none';

    const form = document.getElementById("footer_form");
    form.reset(); // Optional: Formular zurücksetzen
  }   

 function OpenForm(project)
 {
  document.getElementById("DeleteForm").style.display = "block";
  // document.getElementById("ScreenWrapperID").style.pointerEvents = "none";
  const ScreenWrapper = document.getElementsByClassName("ScreenWrapper")[0]
  var pname = document.getElementById("pname");
  pname.value=project;
  ScreenWrapper.style.backgroundColor = "rgba(0, 0, 0, 0.3)";
  ScreenWrapper.style.pointerEvents = "none";
  const buttons = document.querySelectorAll(".ScreenWrapper button");
  buttons.forEach(button => {
    button.disabled = true; // Deaktiviert Buttons
  }); 
  const form = document.getElementById("SFORM");
  form.reset();
 }
 function closeSidebarForm() {
  document.getElementById("DeleteForm").style.display = "none";
  // document.getElementById("ScreenWrapperID").style.pointerEvents = "none";
  const ScreenWrapper = document.getElementsByClassName("ScreenWrapper")[0]
  ScreenWrapper.style.pointerEvents = "";
  ScreenWrapper.style.backgroundColor = "rgba(0, 0, 0, 0)";
  const buttons = document.querySelectorAll(".ScreenWrapper button");
  buttons.forEach(button => {
    button.disabled = false; // Deaktiviert Buttons
  }); 
  const form = document.getElementById("SFORM");
  form.reset();
 }



 function show_data(dataID) {
  console.log(dataID)
  const paragraphs = document.getElementById(`itemdata-${dataID}`);
  // const buttons = document.querySelectorAll('.show_button')
    if (paragraphs.style.display === 'none' || !paragraphs.style.display) {
      paragraphs.style.display = 'block';
      console.log("if")
    } else {
      paragraphs.style.display = 'none';
      console.log("else")
    }

  /*buttons.forEach(button => {
    // Event-Listener nur einmal registrieren
    if (!button.dataset.listenerAdded) {
      button.addEventListener('click', () => {
        // Ziel-Div ermitteln
        const targetId = button.getAttribute('data-target');
        const targetDiv = document.getElementById(targetId);

        // Div ein- oder ausblenden
        if (targetDiv.style.display === 'none' || !targetDiv.style.display) {
          targetDiv.style.display = 'block'; // Einblenden
        } else {
          targetDiv.style.display = 'none'; // Ausblenden
        }
      });

      // Vermerken, dass der Listener hinzugefügt wurde
      button.dataset.listenerAdded = 'true';
    }
  });*/
}



function Impressum() {
  window.location.href = "Impressum.php"; // Relativer Pfad zur neuen Seite
}
function Index() {
  window.location.href = "index.php"; // Relativer Pfad zur neuen Seite
}