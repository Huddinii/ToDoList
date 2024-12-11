/* Set the width of the sidebar to 250px and the left margin of the page content to 250px */
function changeNav() {
  var sidebarElements = document.getElementById("sidebarelements")
  if (sidebarElements.style.display === "none"){
    setTimeout(() => {
    sidebarElements.style.display = "block";
  }, 10);
  } else {
    setTimeout(() => {
    sidebarElements.style.display = "none";
  }, 10);
  }
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
        var Catergorie = document.getElementById("PriorityArea");
        // console.log(Catergorie);
        document.getElementById(currentAbteilung).appendChild(newItem);
        console.log(Catergorie);
  
        closeFrom();
  }

  function Logout() {
    window.location.href = "login.php"; // Relativer Pfad zur neuen Seite
}

function Impressum() {
  window.location.href = "Impressum.php"; // Relativer Pfad zur neuen Seite
}