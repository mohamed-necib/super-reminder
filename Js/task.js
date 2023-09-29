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

// fonction permettant de récupérer les listes en BDD
async function getLists() {
  const response = await fetch("taskTreatment.php?getLists");
  const lists = await response.json();

  console.log(lists);
  listContainer.innerHTML = "";
  lists.forEach((list) => {
    // div de la liste
    let newDiv = document.createElement("div");
    newDiv.classList.add("list-card");
    newDiv.setAttribute("data-id", list.id);
    // div du title et de la croix
    let titleDiv = document.createElement("div");
    titleDiv.classList.add("title-list");

    let newTitle = document.createElement("h3");
    newTitle.innerHTML = list.title;
    titleDiv.appendChild(newTitle);
    let span = document.createElement("span");
    span.classList.add("cross-list");
    span.setAttribute("data-id", list.id);
    span.innerHTML = "\u00D7";
    titleDiv.appendChild(span);
    newDiv.appendChild(titleDiv);
    listContainer.appendChild(newDiv);

    //création du formulaire pour créer une tâche
    let newForm = document.createElement("form");
    newForm.classList.add("formTask", "row");
    newForm.setAttribute("data-id", list.id);
    newDiv.appendChild(newForm);

    // input du title
    let newInput = document.createElement("input");
    newInput.classList.add("inputTask");
    newInput.setAttribute("type", "text");
    newInput.setAttribute("name", "title");
    newInput.setAttribute("placeholder", "Ajouter une tâche");
    newForm.appendChild(newInput);

    // select de la priorisation
    let newSelect = document.createElement("select");
    newSelect.classList.add("selectTask");
    newSelect.setAttribute("name", "priority");
    newForm.appendChild(newSelect);
    let newOption1 = document.createElement("option");
    newOption1.setAttribute("value", "1");
    newOption1.innerHTML = "Urgent";
    newSelect.appendChild(newOption1);
    let newOption2 = document.createElement("option");
    newOption2.setAttribute("value", "2");
    newOption2.innerHTML = "Important";
    newSelect.appendChild(newOption2);
    let newOption3 = document.createElement("option");
    newOption3.setAttribute("value", "3");
    newOption3.setAttribute("selected", "selected");
    newOption3.innerHTML = "Pas important";
    newSelect.appendChild(newOption3);

    // bouton de submit
    let newButton = document.createElement("button");
    newButton.classList.add("addTask");
    newButton.setAttribute("type", "submit");
    newButton.innerHTML = "+";
    newForm.appendChild(newButton);

    // Création de la liste des tâches
    let newUl = document.createElement("ul");
    newUl.classList.add("task-list");
    newDiv.appendChild(newUl);
    getTasks(list.id, newUl);
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

// Fonction permettant de récupérer les tâches qui sont en BDD
async function getTasks(list_id, ul) {
  const formData = new FormData();
  formData.append("list_id", list_id);
  const response = await fetch("taskTreatment.php?getTasks", {
    method: "POST",
    body: formData,
  });
  // on récupère les tâches en json
  const tasks = await response.json();

  // création de toutes les tâches que l'on mettra dans le ul
  tasks.forEach((task) => {
    let newLi = document.createElement("li");
    newLi.classList.add("task");
    newLi.setAttribute("data-id", task.id);
    newLi.innerHTML = task.title;
    // creation de la div qui acceuillera les span
    let divSpan = document.createElement("div");
    divSpan.classList.add("div-span");
    // creation de la pastille de couleur en fonction de la priorité
    let pill = document.createElement("span");
    pill.classList.add("pill", "pill-" + task.priority);
    divSpan.appendChild(pill);
    // création de la croix;
    let span = document.createElement("span");
    span.classList.add("cross");
    span.setAttribute("data-id", task.id);
    span.innerHTML = "\u00D7";
    divSpan.appendChild(span);
    newLi.appendChild(divSpan);
    ul.appendChild(newLi);
    if (task.finish == 1) {
      newLi.classList.add("checked");
    }
  });
}

// Fonction pour ajouter une tâche dans une liste
async function addTask(idList, form) {
  const formData = new FormData(form);
  formData.append("list_id", idList);
  formData.append("addTask", "ok");
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

//Fonction qui nous permet d'update une tâche de la liste à laquelle elle appartient
async function updateTask(idTask, done) {
  const formData = new FormData();
  formData.append("id", idTask);
  formData.append("finish", done);
  formData.append("updateTask", "ok");
  const response = await fetch("taskTreatment.php", {
    method: "POST",
    body: formData,
  });
  const data = await response.text();
}

// Fonction pour supprimer une tâche
async function deleteTask(idTask) {
  const formData = new FormData();
  formData.append("id", idTask);
  formData.append("deleteTask", "ok");
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
  //supprimer une liste grâce à la classe cross-list
  if (e.target.classList.contains("cross-list")) {
    let idList = e.target.getAttribute("data-id");
    deleteList(idList);
  }

  //ajouter une tâche grâce à la classe addTask
  if (e.target.classList.contains("addTask")) {
    e.preventDefault();
    let idList = e.target.parentNode.getAttribute("data-id");
    let form = e.target.parentNode;
    let inputTask = e.target.parentNode.querySelector(".inputTask");
    let task = inputTask.value;
    if (task === "") {
      alert("Veuillez entrer une tâche");
    } else {
      addTask(idList, form);
      inputTask.value = "";
      getLists();
    }
  }

  //update une task grâce à la classe task
  if (e.target.classList.contains("task")) {
    let idTask = e.target.getAttribute("data-id");
    if (e.target.classList.contains("checked")) {
      let done = 0;
      updateTask(idTask, done);
    } else {
      let done = 1;
      updateTask(idTask, done);
    }
    // si la tâche est terminée, on lui donne la classe checked sinon on l'enlève
    e.target.classList.toggle("checked");
  }
  //supprimer une task grâce à la classe cross
  else if (e.target.classList.contains("cross")) {
    let idTask = e.target.getAttribute("data-id");
    deleteTask(idTask);
  }
});
