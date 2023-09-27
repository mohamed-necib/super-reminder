const formList = document.querySelector("#formList");
const inputBox = document.querySelector("#input-box");
const listContainer = document.querySelector("#list-container");


// ----------------------------------------------------------
//               PARTIE LIST
// ----------------------------------------------------------
// fonction permettant l'ajout d'une tâche en BDD
async function addList(form) {
  const formData = new FormData(form);
  formData.append("addList", "ok");
  const response = await fetch("taskTreatment.php", {
    method: "POST",
    body: formData,
  });
  const data = await response.text();

  if (data === "ok") {
    inputBox.value = "";
    getLists();
  } else {
    alert("Error");
  }
}

// fonction permettant de récupérer les tâches en BDD
async function getLists() {
  const response = await fetch("taskTreatment.php?getLists");
  const datas = await response.json();

  listContainer.innerHTML = "";
  datas.forEach((data) => {
   
    let newLi = document.createElement("li");
    newLi.classList.add("List");
    // on verifie si au retour d'information de la bdd la tâche est terminée ou non
    if (data.finish === 1) {
      newLi.classList.add("checked");
    }
    newLi.setAttribute("data-id", data.id);
    newLi.innerHTML = data.title;
    listContainer.appendChild(newLi);
    let span = document.createElement("span");
    span.classList.add("cross");
    span.setAttribute("data-id", data.id);
    span.innerHTML = "\u00D7";
    newLi.appendChild(span);
  });
}

// fonction permettant de mettre à jour le statut d'une tâche en BDD
async function updateList(idList, done) {
  const formData = new FormData();
  formData.append("id", idList);
  formData.append("finish", done);
  formData.append("updateList", "ok");
  const response = await fetch("taskTreatment.php", {
    method: "POST",
    body: formData,
  });
  const data = await response.text();
}

// Fonction permettant de supprimer une tâche en BDD
async function deleteList(idList) {
  const formData = new FormData();
  formData.append("id", idList);
  formData.append("deleteList", "ok");
  const response = await fetch("taskTreatment.php", {
    method: "POST",
    body: formData,
  });
  const data = await response.text();

  if (data === "ok") {
    getLists();
  } else {
    alert("Error");
  }
}

// ------------------------------------------------------------
//                PARTIE TASKS
// ------------------------------------------------------------



// -------------------------------------------------------------
//                PARTIE APPEL DES FONCTIONS (+Listener)
// -------------------------------------------------------------

getLists();

formList.addEventListener("submit", (e) => {
  e.preventDefault();
  if (inputBox.value === "") {
    alert("Veuillez entrez une tâche");
  } else {
    addList(formList);
  }
});

listContainer.addEventListener("click", (e) => {
  if (e.target.classList.contains("List")) {
    let idList = e.target.getAttribute("data-id");
    if (e.target.classList.contains("checked")) {
      let done = 0;
      updateList(idList, done);
    } else {
      let done = 1;
      updateList(idList, done);
    }
    // si la tâche est terminée, on lui donne la classe checked sinon on l'enlève
    e.target.classList.toggle("checked");
  }
  if (e.target.classList.contains("cross")) {
    let idList = e.target.getAttribute("data-id");
    deleteList(idList);
  }
});
