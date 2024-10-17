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