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

document.addEventListener("DOMContentLoaded", () => {
const resizer = document.getElementById('test2');
const sidebar = document.getElementById('test1');
let isResizing = false;
console.log("test");

resizer.addEventListener('mousedown', (e) => {
  isResizing = true;
  document.body.style.cursor = 'ew-resize'; // Cursor ändern
  console.log("angeklickt");
  e.preventDefault();
});

document.addEventListener('mousemove', (e) => {
  if (!isResizing) return;
  e.preventDefault();
  // Berechnung der neuen Breite
  const newWidth = e.clientX;
  if (newWidth > 150 && newWidth < 600) { // Mindest- und Maximalbreite
    sidebar.style.width = `${newWidth}px`;
    console.log("bewegt");
  }
});

document.addEventListener('mouseup', () => {
  isResizing = false;
  document.body.style.cursor = 'default'; // Cursor zurücksetzen
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

  function Logout() {
    window.location.href = "login.php"; // Relativer Pfad zur neuen Seite
}

function Impressum() {
  window.location.href = "Impressum.php"; // Relativer Pfad zur neuen Seite
}