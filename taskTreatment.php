<?php
session_start();
require_once './Class/TasksList.php';

//Création d'une tâche via la classe List:
if (isset($_POST["addList"])) {
  $title = $_POST["title"];
  $user_id = $_SESSION["user"]->id;
  $list = new TasksList();
  echo $list->createList($title, $user_id);
}
//Fin d'une tâche via la classe List:
if (isset($_POST["updateList"])) {
  $id = $_POST["id"];
  $done = $_POST["finish"];
  $list = new TasksList();
  echo $list->finishList($id, $done);
}

//Suppression d'une tâche via la classe List:
if (isset($_POST["deleteList"])) {
  $id = $_POST["id"];
  $list = new TasksList();
  echo $list->deleteList($id);
}

//Récupération des tâches via la classe List:
if (isset($_GET["getLists"])) {
  $user_id = $_SESSION["user"]->id;
  $list = new TasksList();
  $datas = $list->getLists($user_id);
  echo json_encode($datas);
}
