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

  function OpenPopup() {
    document.getElementById("myForm").style.display = "block";
    // document.getElementById("ScreenWrapperID").style.pointerEvents = "none";
    const ScreenWrapper = document.getElementsByClassName("ScreenWrapper")[0]
    ScreenWrapper.style.pointerEvents = "none";
    ScreenWrapper.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
    
  }