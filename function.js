/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function changeNav() {
  var sidebarElements = document.getElementById("sidebarelements")
  if (sidebarElements.style.display === "none"){
    sidebarElements.style.display = "block";
  } else {
    sidebarElements.style.display = "none";
  }
}
  /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */

  function allowDrop(ev) {
    ev.preventDefault();
  }
  
  function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
    console.log("dragging:", ev.target.id);
  }
  
  function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var target = ev.target;
  
    // Überprüfen, ob das Drop-Ziel eine Kategorie ist oder ein leeres Ziel enthält
    while (!target.classList.contains("PriorityElement")) {
      target = target.parentNode;
    }
    // Füge das gezogene Element in die Ziel-Kategorie ein
    target.appendChild(document.getElementById(data));
    console.log("dropped:", data);
  }


  let currentAbteilung = '';

  function OpenPopup(abteilung) {


    document.getElementById("myForm").style.display = "block";
    // document.getElementById("ScreenWrapperID").style.pointerEvents = "none";
    const ScreenWrapper = document.getElementsByClassName("ScreenWrapper")[0]
    ScreenWrapper.style.pointerEvents = "none";
    ScreenWrapper.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
    const inputField = document.getElementById("text_input");
    const datetField = document.getElementById("date_input");
    const biginputField = document.getElementById("big_text_input");
    inputField.value = ''; // Eingabefeld leeren
    datetField.value = ''; // Eingabefeld leeren
    biginputField.value = ''; // Eingabefeld leeren
    currentAbteilung = abteilung;
    console.log(currentAbteilung);
    
  }

  function closeFrom() {
    document.getElementById("myForm").style.display = "none";
    const ScreenWrapper = document.getElementsByClassName("ScreenWrapper")[0]
    ScreenWrapper.style.pointerEvents = "";
    ScreenWrapper.style.backgroundColor = "rgba(0, 0, 0, 0)";
  }

  function createToDo() {
    var myInput = document.getElementById("text_input").value;
    
        // Neues Element erstellen
        var newItem = document.createElement("div");
        newItem.className = "item";
        newItem.draggable = true;
        newItem.ondragstart = drag;
        newItem.id = "item5"; // Eindeutige ID vergeben
        newItem.textContent = myInput;
    
        // Füge das neue Element standardmäßig in die "Medium" Kategorie ein
        var Catergorie = document.getElementById("PriorityElement");
        // console.log(Catergorie);
        document.getElementById(currentAbteilung).appendChild(newItem);
        console.log(Catergorie);
  
        closeFrom();
  }

