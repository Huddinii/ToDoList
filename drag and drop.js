document.querySelectorAll('.PriorityHeader').forEach(element => {
  element.addEventListener('dragstart', function(ev) {
    ev.preventDefault(); // Verhindert das Ziehen dieser Elemente
    console.log("Drag über Header oder Button verhindert.");
  });
});

function allowDrop(ev) {
    ev.preventDefault();
  }

  function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
    ev.target.classList.add("drag-active");
  }

  function drop(ev) {
    ev.preventDefault();
    const data = ev.dataTransfer.getData("text");
    const draggedElement = document.getElementById(data);

    let target = ev.target;
    while (target && !target.classList.contains("PriorityArea")) {
      target = target.parentNode;
    }

    if (!target) {
      console.error("Kein gültiges Drop-Ziel gefunden.");
      return;
    }

    const closestChild = Array.from(target.children).find(child => {
      const rect = child.getBoundingClientRect();
      return ev.clientY < rect.top + rect.height / 2;
    });

    if (closestChild) {
      target.insertBefore(draggedElement, closestChild);
    } else {
      target.appendChild(draggedElement);
    }

    // Entferne alle temporären "Platzhalter"-Styles, wenn der Drop abgeschlossen ist
    Array.from(target.children).forEach(child => {
      child.style.transition = "none"; // Stelle sicher, dass keine Animationen nach dem Drop stattfinden
    });
  }

  // Funktion für das "Hover"-Verhalten: verschiebe die anderen Elemente, wenn das Element darüber gezogen wird
  function onDragOver(ev) {
    const target = ev.target;
    const draggedElement = document.getElementById(ev.dataTransfer.getData("text"));

    // Verhindere das Standardverhalten
    ev.preventDefault();

    if (target && target !== draggedElement) {
      const rect = target.getBoundingClientRect();
      const offsetY = ev.clientY - rect.top;

      // Wenn das Element über das Ziel-Element gezogen wird, schiebe es auf
      if (offsetY < rect.height / 2) {
        target.style.marginTop = "10px"; // Erhöhe den Abstand, um Platz zu schaffen
        target.style.transition = "margin-top 0.3s"; // Sanfte Animation
      } else {
        target.style.marginTop = ""; // Rückgängig machen, wenn es nicht über dem Ziel ist
      }
    }
  }
  const closestChild = Array.from(target.children).find(child => {
    const rect = child.getBoundingClientRect();
    return ev.clientY < rect.top + rect.height / 2;
  });




  // Event-Listener für alle Kinder innerhalb des Containers, um das Verschieben der anderen Elemente zu ermöglichen
  document.querySelectorAll('.PriorityArea div').forEach(element => {
    element.addEventListener('dragover', onDragOver);
  });