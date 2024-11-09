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

const items = document.querySelectorAll(".PriorityCategories .item");
const lists = document.querySelectorAll(".PriorityCategories .PriorityElement");
let currentItem = null;

function dragStart(e){
  if(![...e.target.classList].includes("item")){
    e.preventDefault();
    return;
  }
  currentItem = e.target;
  e.target.classList.add("drag-active");
  setTimeout(()=>{
    e.target.style.display = "none";
  },0);
}

  function dragEnd(e) {
    currentItem = null;
    e.target.classList.remove("drag-active")
    e.target.style.display = "flex";
  }
  
  function dragOver(e) {
    e.preventDefault();
  }

  function dragEnter(e) {
    e.preventDefault();
    e.target.classList.add("hoverd");
  }

  function dragLeave(e) {
    e.preventDefault();
    e.target.classList.remove("hoverd");
  }

function drop(e) {
  if(![...e.target.classList].includes("PriorityElement")){
    e.preventDefault();
    return;
  }
  e.target.classList.remove("hoverd");
  e.target.append(currentItem);
  currentItem = null;
}

items.forEach((item) => {
  item.addEventListener("dragstart", dragStart);
  item.addEventListener("dragend", dragEnd);
});

lists.forEach((PriorityElement) => {
  PriorityElement.addEventListener("dragover", dragOver);
  PriorityElement.addEventListener("dragenter", dragEnter);
  PriorityElement.addEventListener("dragleave", dragLeave);
  PriorityElement.addEventListener("drop", drop);

})



