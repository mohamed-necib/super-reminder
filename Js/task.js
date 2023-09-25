const formTask = document.querySelector('#formTask');


// fonction permettant l'ajout d'une tâche en BDD
async function addTask(form) {
  const formData = new FormData(form);
  formData.append('addTask', 'ok');
  const response = await fetch('task.php', {
    method: 'POST',
    body: formData
  });
  const data = await response.text();
  console.log('DATA ========>', data);
}

// fonction permettant de récupérer les tâches en BDD
 async function getTasks() {
  const response = await fetch('task.php');
  const datas = await response.json();
  console.log('DATA ========>', datas);

  // on récupère l'élément HTML qui va contenir les tâches
  const taskList = document.querySelector('#taskList');
  // on vide le contenu de la liste
  taskList.innerHTML = '';
  // on boucle sur les tâches
  
}
  
// fonction permettant de mettre à jour le statut d'une tâche en BDD
 async function updateTask() {
  const formData = new FormData(formTask);
  formData.append('updateTask', 'ok');
  const response = await fetch('task.php', {
    method: 'POST',
    body: formData
  });
  const data = await response.text();
  console.log('DATA ========>', data);
}

// fonction permettant de supprimer une tâche en BDD
async function deleteTask(){
  const formData = new FormData(formTask);
  formData.append('deleteTask', 'ok');
  const response = await fetch('task.php', {
    method: 'POST',
    body: formData
  });
  const data = await response.text();
  console.log('DATA ========>', data);
}


formTask.addEventListener('submit', (e) => {
  e.preventDefault();
  addTask(formTask);
}
);




