const inputBox = document.querySelector("#input-box");
const listContainer = document.querySelector("#list-container");

// Fonction pour ajouter une tâche
function addTask() {
  if (inputBox.value === "") {
    alert("Veuillez entrer une tâche");
  } else {
    let newLi = document.createElement("li");
    newLi.innerHTML = inputBox.value;
    listContainer.appendChild(newLi);
    let span = document.createElement("span");
    span.innerHTML = "\u00D7";
    newLi.appendChild(span);
  }
  inputBox.value = "";
}
