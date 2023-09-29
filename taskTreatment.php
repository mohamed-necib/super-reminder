<?php
session_start();
require_once './Class/TasksList.php';
require_once './Class/Task.php';


// -------------------------------------------------
//            LIST
// -------------------------------------------------

//Création d'une liste via la classe List:
if (isset($_POST["addList"])) {
  $title = $_POST["title"];
  $user_id = $_SESSION["user"]->id;
  $list = new TasksList();
  echo $list->createList($title, $user_id);
}

//Fin d'une liste via la classe List:
if (isset($_POST["updateList"])) {
  $id = $_POST["id"];
  $done = $_POST["finish"];
  $list = new TasksList();
  echo $list->finishList($id, $done);
}

//Suppression d'une liste via la classe List:
if (isset($_POST["deleteList"])) {
  $id = $_POST["id"];
  $list = new TasksList();
  echo $list->deleteList($id);
}

//Récupération des listes via la classe List:
if (isset($_GET["getLists"])) {
  $user_id = $_SESSION["user"]->id;
  $list = new TasksList();
  $datas = $list->getLists($user_id);
  echo json_encode($datas);
}


// -------------------------------------------------
//              TASKS
// -------------------------------------------------


// Création d'une task via la classe Task:
if (isset($_POST["addTask"])) {
  $title = $_POST["title"];
  $priority = $_POST["priority"];
  $list_id = $_POST["list_id"];
  $task = new Task();
  echo $task->createTask($title, $priority, $list_id);
}

// Suppression d'une task via la classe Task:
if (isset($_POST["deleteTask"])) {
  $id = $_POST["id"];
  $task = new Task();
  echo $task->deleteTask($id);
}

// Récupération des tasks via la classe Task:
if (isset($_GET["getTasks"])) {
  $list_id = $_POST["list_id"];
  $task = new Task();
  $datas = $task->getTasks($list_id);
  echo json_encode($datas);
}

// Fin d'une task via la classe Task:
if (isset($_POST["updateTask"])) {
  $id = $_POST["id"];
  $done = $_POST["finish"];
  $task = new Task();
  echo $task->finishTask($id, $done);
}

// -------------------------------------------------